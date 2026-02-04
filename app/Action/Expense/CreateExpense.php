<?php

declare(strict_types=1);

namespace App\Action\Expense;

use Illuminate\Support\Facades\DB;

class CreateExpense
{
    public function execute(array $data): void
    {
        DB::table('expenses')->insert([
            'title' => $data['title'],
            'amount' => $data['amount'],
            'type' => $data['type'],
            'status' => $data['status'],
            'user_id' => $data['userId'],
            'category_id' => $data['category_id'] ?? null,
            'payment_date' => $data['status'] === 'paid' ? now() : null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
