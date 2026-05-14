<?php

declare(strict_types=1);

namespace App\Action\Dashboard;

use App\DTO\Dashboard\GetSummaryInput;
use App\DTO\Dashboard\GetSummaryOutput;
use App\Models\CreditCardStatement;
use App\Models\Expense;
use App\Models\Source;
use App\Support\Logging\FormatsLogMessage;
use Psr\Log\LoggerInterface;

class GetSummaryAction
{
    use FormatsLogMessage;

    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    public function execute(GetSummaryInput $input): GetSummaryOutput
    {
        $this->logger->info($this->formatLogMessage('started'), [
            'user_id' => $input->userId,
            'default_source_id' => $input->defaultSourceId,
        ]);

        $startedAt = microtime(true);
        $now = now();
        $windowStart = $now->subDays(29)->startOfDay();

        $cashExpenseQuery = Expense::query()
            ->join('sources', 'expenses.source_id', '=', 'sources.id')
            ->where('expenses.user_id', $input->userId)
            ->where('sources.type', Source::TYPE_CASH_LIKE)
            ->where('expenses.source_id', $input->defaultSourceId);

        $totalReceive = (clone $cashExpenseQuery)
            ->where('expenses.type', 'income')
            ->where('expenses.status', 'paid')
            ->sum('expenses.amount');

        $totalExpense = (clone $cashExpenseQuery)
            ->where('expenses.type', 'expense')
            ->where('expenses.status', 'paid')
            ->sum('expenses.amount');

        $totalIncomePending = (clone $cashExpenseQuery)
            ->where('expenses.type', 'income')
            ->where('expenses.status', 'pending')
            ->sum('expenses.amount');

        $totalExpensePending = (clone $cashExpenseQuery)
            ->where('expenses.type', 'expense')
            ->where('expenses.status', 'pending')
            ->sum('expenses.amount');

        $totalReceive30Days = (clone $cashExpenseQuery)
            ->where('expenses.type', 'income')
            ->where('expenses.status', 'paid')
            ->whereBetween('expenses.payment_date', [$windowStart, $now->endOfDay()])
            ->sum('expenses.amount');

        $totalExpense30Days = (clone $cashExpenseQuery)
            ->where('expenses.type', 'expense')
            ->where('expenses.status', 'paid')
            ->whereBetween('expenses.payment_date', [$windowStart, $now->endOfDay()])
            ->sum('expenses.amount');

        $spentToday = (clone $cashExpenseQuery)
            ->where('expenses.type', 'expense')
            ->where('expenses.status', 'paid')
            ->whereDate('expenses.payment_date', $now)
            ->sum('expenses.amount');

        $spentMonth = (clone $cashExpenseQuery)
            ->where('expenses.type', 'expense')
            ->where('expenses.status', 'paid')
            ->whereYear('expenses.payment_date', $now->year)
            ->whereMonth('expenses.payment_date', $now->month)
            ->sum('expenses.amount');

        $expectedTotal = ($totalReceive + $totalIncomePending) - ($totalExpense + $totalExpensePending);
        $currentBalance = $totalReceive - $totalExpense;
        $expectedExpenses = $totalExpense + $totalExpensePending;
        $creditCardOpenTotal = CreditCardStatement::query()
            ->join('sources', 'credit_card_statements.source_id', '=', 'sources.id')
            ->where('sources.user_id', $input->userId)
            ->where('credit_card_statements.status', '!=', CreditCardStatement::STATUS_PAID)
            ->sum('credit_card_statements.total_amount');
        $creditCardLimitUsed = Expense::query()
            ->join('sources', 'expenses.source_id', '=', 'sources.id')
            ->where('expenses.user_id', $input->userId)
            ->where('sources.type', Source::TYPE_CREDIT_CARD)
            ->where('expenses.occurrence_type', Expense::OCCURRENCE_PURCHASE)
            ->where('expenses.status', '!=', 'paid')
            ->sum('expenses.amount');

        $this->logger->info($this->formatLogMessage('completed'), [
            'user_id' => $input->userId,
            'total_receive' => $totalReceive,
            'total_expense' => $totalExpense,
            'expected_total' => $expectedTotal,
            'final_balance' => $expectedTotal,
            'total_receive_30_days' => $totalReceive30Days,
            'total_expense_30_days' => $totalExpense30Days,
            'total_income_pending' => $totalIncomePending,
            'total_expense_pending' => $totalExpensePending,
            'current_balance' => $currentBalance,
            'expected_expenses' => $expectedExpenses,
            'spent_today' => $spentToday,
            'spent_month' => $spentMonth,
            'credit_card_open_total' => $creditCardOpenTotal,
            'credit_card_limit_used' => $creditCardLimitUsed,
            'query_time_ms' => (int) ((microtime(true) - $startedAt) * 1000),
        ]);

        return new GetSummaryOutput(
            (int) $totalReceive,
            (int) $totalExpense,
            (int) $expectedTotal,
            (int) $expectedTotal,
            (int) $totalReceive30Days,
            (int) $totalExpense30Days,
            (int) $totalIncomePending,
            (int) $totalExpensePending,
            (int) $currentBalance,
            (int) $expectedExpenses,
            (int) $spentToday,
            (int) $spentMonth,
            (int) $creditCardOpenTotal,
            (int) $creditCardLimitUsed,
        );
    }
}
