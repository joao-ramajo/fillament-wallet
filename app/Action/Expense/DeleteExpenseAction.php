<?php

declare(strict_types=1);

namespace App\Action\Expense;

use App\Models\Expense;
use App\Support\CreditCard\CreditCardStatementService;
use DomainException;

class DeleteExpenseAction
{
    public function __construct(
        private readonly CreditCardStatementService $creditCardStatementService,
    ) {}

    public function execute(int $expenseId, int $userId): void
    {
        $expense = Expense::query()->find($expenseId);

        throw_unless($expense, DomainException::class, 'Despesa não encontrada.');

        throw_if($expense->user_id !== $userId, DomainException::class, 'Você não tem permissão para deletar esta despesa.');

        throw_if($expense->occurrence_type === Expense::OCCURRENCE_INVOICE_PAYMENT, DomainException::class, 'Registros de cartão devem ser gerenciados pelo fluxo da fatura.');

        $statementId = $expense->credit_card_statement_id;
        $expense->delete();

        if ($statementId !== null) {
            $this->creditCardStatementService->syncById($statementId);
        }
    }
}
