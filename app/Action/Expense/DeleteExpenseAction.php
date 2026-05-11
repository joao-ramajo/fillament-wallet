<?php

declare(strict_types=1);

namespace App\Action\Expense;

use App\Models\Expense;
use DomainException;

class DeleteExpenseAction
{
    public function execute(int $expenseId, int $userId): void
    {
        $expense = Expense::query()->find($expenseId);

        throw_unless($expense, DomainException::class, 'Despesa não encontrada.');

        throw_if($expense->user_id !== $userId, DomainException::class, 'Você não tem permissão para deletar esta despesa.');

        throw_if($expense->origin_type === Expense::ORIGIN_CREDIT_CARD || $expense->occurrence_type === Expense::OCCURRENCE_INVOICE_PAYMENT, DomainException::class, 'Registros de cartão devem ser gerenciados pelo fluxo da fatura.');

        $expense->delete();
    }
}
