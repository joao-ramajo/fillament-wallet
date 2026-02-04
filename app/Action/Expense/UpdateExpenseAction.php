<?php

declare(strict_types=1);

namespace App\Action\Expense;

use App\Models\Expense;
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

        $expense->update($data);
    }
}
