<?php declare(strict_types=1);

namespace App\Action;

use App\Models\Category;
use App\Models\Expense;
use Exception;
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

    /**
     * Executa a importação do CSV.
     */
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

            $imported = 0;
            $skipped = 0;
            $batch = [];

            while (($data = fgetcsv($handle, 0, ';')) !== false) {

                $row = array_combine($header, $data);

                if ($this->isDuplicate($row)) {
                    $skipped++;
                    continue;
                }

                $category = $this->findOrCreateCategory($row['CATEGORY_NAME']);

                $batch[] = [
                    'title' => $row['TITLE'],
                    'amount' => $row['AMOUNT'],
                    'status' => $row['STATUS'],
                    'type' => $row['TYPE'],
                    'payment_date' => $row['PAYMENT_DATE'] !== '-' ? $row['PAYMENT_DATE'] : null,
                    'due_date' => $row['DUE_DATE'] !== '-' ? $row['DUE_DATE'] : null,
                    'created_at' => $row['CREATED_AT'],
                    'updated_at' => now(),
                    'user_id' => Auth::id(),
                    'category_id' => $category?->id,
                ];

                if (count($batch) >= 100) {
                    DB::table('expenses')->insert($batch);
                    $imported += count($batch);
                    $batch = [];
                }
            }

            if (!empty($batch)) {
                DB::table('expenses')->insert($batch);
                $imported += count($batch);
            }

            fclose($handle);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao importar CSV: ' . $e->getMessage());
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
