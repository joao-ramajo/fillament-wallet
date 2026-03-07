<?php

declare(strict_types=1);

namespace App\Action\Expense;

use App\Models\Expense;
use Carbon\Carbon;
use DomainException;
use Illuminate\Support\Facades\Auth;

class UpdateExpenseAction
{
    public function execute(array $data, int $id): void
    {
        $expense = Expense::findOrFail($id);

        if ($expense->user_id !== Auth::id()) {
            throw new DomainException('Você não pode alterar este registro');
        }

        if (($data['status'] ?? null) === 'paid') {
            $data['payment_date'] = isset($data['payment_date']) && $data['payment_date'] !== null
                ? Carbon::createFromFormat('Y-m-d', $data['payment_date'])->startOfDay()
                : now();
        } else {
            $data['payment_date'] = null;
        }

        $expense->update($data);
    }
}
