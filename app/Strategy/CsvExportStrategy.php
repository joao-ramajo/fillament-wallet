<?php

namespace App\Strategy;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvExportStrategy implements ExportStrategyInterface
{
    public function execute(): StreamedResponse
    {
        $user = Auth::user();

        $name = Str::slug($user->name);

        $fileName = "{$name}-fillament-wallet-" . Str::uuid() . '.csv';

        $callback = $this->generate($user->id);

        return response()->streamDownload($callback, $fileName, [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ]);
    }

    public function generate(int $userId): callable
    {
        return function () use ($userId) {
            $file = fopen('php://output', 'w');

            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, [
                'TITLE',
                'AMOUNT',
                'STATUS',
                'TYPE',
                'PAYMENT_DATE',
                'DUE_DATE',
                'CREATED_AT',
                'CATEGORY_NAME',
                'BANK_ACCOUNT_NAME'
            ], ';');

            DB::table('expenses')
                ->leftJoin('categories', 'categories.id', '=', 'expenses.category_id')
                ->leftJoin('bank_accounts', 'bank_accounts.id', '=', 'expenses.bank_account_id')
                ->where('expenses.user_id', $userId)
                ->select(
                    'expenses.title',
                    'expenses.amount',
                    'expenses.status',
                    'expenses.type',
                    'expenses.payment_date',
                    'expenses.due_date',
                    'expenses.created_at',
                    'categories.name as category_name',
                    'bank_accounts.name as bank_account_name'
                )
                ->orderBy('expenses.created_at', 'desc')
                ->chunk(1000, function ($expenses) use ($file) {
                    foreach ($expenses as $expense) {
                        fputcsv($file, [
                            $expense->title ?? '-',
                            $expense->amount,
                            $expense->status ?? '-',
                            $expense->type ?? '-',
                            $expense->payment_date ?? '-',
                            $expense->due_date ?? '-',
                            $expense->created_at ?? '-',
                            $expense->category_name ?? '-',
                            $expense->bank_account_name ?? '-',
                        ], ';');
                    }
                });

            fclose($file);
        };
    }
}
