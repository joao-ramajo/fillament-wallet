<?php

declare(strict_types=1);

namespace App\Action;

use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ImportCsvData
{
    private const REQUIRED_HEADERS = [
        'TITLE', 'AMOUNT', 'STATUS', 'TYPE', 'PAYMENT_DATE',
        'DUE_DATE', 'CREATED_AT', 'CATEGORY_NAME'
    ];

    public function execute(UploadedFile $file): bool
    {
        $validator = Validator::make(
            ['file' => $file],
            ['file' => 'required|file|mimes:csv,txt|max:10240']
        );

        if ($validator->fails()) {
            return false;
        }

        try {
            DB::beginTransaction();

            // 👇 ESSENCIAL EM PRODUÇÃO
            ini_set('auto_detect_line_endings', '1');

            $handle = fopen($file->getRealPath(), 'r');
            if (!$handle) {
                return false;
            }

            $header = fgetcsv($handle, 0, ';');
            $header[0] = preg_replace('/^\x{FEFF}/u', '', $header[0]);

            if (!$this->validateHeaders($header)) {
                fclose($handle);
                return false;
            }

            $batch = [];

            while (($data = fgetcsv($handle, 0, ';')) !== false) {
                // 👇 proteção contra linhas quebradas
                if (count($data) !== count($header)) {
                    Log::warning('Linha CSV inválida ignorada', [
                        'data' => $data
                    ]);
                    continue;
                }

                // 👇 normaliza encoding
                $data = array_map(
                    fn ($v) => trim(
                        mb_convert_encoding($v, 'UTF-8', 'UTF-8,ISO-8859-1,WINDOWS-1252')
                    ),
                    $data
                );

                $row = array_combine($header, $data);

                if ($this->isDuplicate($row)) {
                    continue;
                }

                $category = $this->findOrCreateCategory($row['CATEGORY_NAME']);

                $defaultSourceId = DB::table('sources')
                    ->where('user_id', Auth::id())
                    ->where('is_default', true)
                    ->value('id');

                $batch[] = [
                    'title' => $row['TITLE'],
                    'amount' => (int) $row['AMOUNT'],
                    'status' => $row['STATUS'],
                    'type' => $row['TYPE'],
                    'payment_date' => $row['PAYMENT_DATE'] !== '-' ? $row['PAYMENT_DATE'] : null,
                    'due_date' => $row['DUE_DATE'] !== '-' ? $row['DUE_DATE'] : null,
                    'created_at' => $row['CREATED_AT'],
                    'updated_at' => now(),
                    'user_id' => Auth::id(),
                    'category_id' => $category?->id,
                    'source_id' => $defaultSourceId,
                ];

                if (count($batch) >= 100) {
                    DB::table('expenses')->insert($batch);
                    $batch = [];
                }
            }

            if (!empty($batch)) {
                DB::table('expenses')->insert($batch);
            }

            fclose($handle);
            DB::commit();

            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Erro ao importar CSV', [
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    private function validateHeaders(array $headers): bool
    {
        foreach (self::REQUIRED_HEADERS as $required) {
            if (!in_array($required, $headers)) {
                return false;
            }
        }
        return true;
    }

    private function isDuplicate(array $row): bool
    {
        return DB::table('expenses')
            ->where('amount', $row['AMOUNT'])
            ->where('created_at', $row['CREATED_AT'])
            ->where('user_id', Auth::id())
            ->exists();
    }

    private function findOrCreateCategory(?string $categoryName): ?Category
    {
        if (!$categoryName || $categoryName === '-') {
            return null;
        }

        $category = Category::where('name', $categoryName)
            ->where(function ($query) {
                $query
                    ->whereNull('user_id')
                    ->orWhere('user_id', Auth::id());
            })
            ->first();

        if (!$category) {
            $category = Category::create([
                'name' => $categoryName,
                'user_id' => Auth::id(),
            ]);
        }

        return $category;
    }
}
