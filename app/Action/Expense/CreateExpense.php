<?php

declare(strict_types=1);

namespace App\Action\Expense;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateExpense
{
    public function execute(array $data): void
    {
        if ($data['source_id'] === null) {
            $data['source_id'] = DB::table('sources')
                ->where('user_id', Auth::id())
                ->where('is_default', true)
                ->value('id');
        }

        $paymentDate = null;
        if ($data['status'] === 'paid') {
            $paymentDate = isset($data['payment_date'])
                ? Carbon::createFromFormat('Y-m-d', $data['payment_date'])->startOfDay()
                : now();
        }

        DB::table('expenses')->insert([
            'title' => $data['title'],
            'amount' => $data['amount'],
            'type' => $data['type'],
            'status' => $data['status'],
            'user_id' => $data['userId'],
            'category_id' => $data['category_id'] ?? null,
            'payment_date' => $paymentDate,
            'source_id' => $data['source_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
