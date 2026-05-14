<?php

declare(strict_types=1);

namespace App\DTO\Dashboard;

readonly class GetSummaryOutput
{
    public function __construct(
        public int $totalReceive,
        public int $totalExpense,
        public int $expectedTotal,
        public int $finalBalance,
        public int $totalReceive30Days,
        public int $totalExpense30Days,
        public int $totalIncomePending,
        public int $totalExpensePending,
        public int $currentBalance,
        public int $expectedExpenses,
        public int $spentToday,
        public int $spentMonth,
        public int $creditCardOpenTotal,
        public int $creditCardLimitUsed,
    ) {}

    /**
     * @return array{
     *     total_receive: int,
     *     total_expense: int,
     *     expected_total: int,
     *     final_balance: int,
     *     total_receive_30_days: int,
     *     total_expense_30_days: int,
     *     total_income_pending: int,
     *     total_expense_pending: int,
     *     current_balance: int,
     *     expected_expenses: int,
     *     spent_today: int,
     *     spent_month: int,
     *     credit_card_open_total: int,
     *     credit_card_limit_used: int
     * }
     */
    public function toArray(): array
    {
        return [
            'total_receive' => $this->totalReceive,
            'total_expense' => $this->totalExpense,
            'expected_total' => $this->expectedTotal,
            'final_balance' => $this->finalBalance,
            'total_receive_30_days' => $this->totalReceive30Days,
            'total_expense_30_days' => $this->totalExpense30Days,
            'total_income_pending' => $this->totalIncomePending,
            'total_expense_pending' => $this->totalExpensePending,
            'current_balance' => $this->currentBalance,
            'expected_expenses' => $this->expectedExpenses,
            'spent_today' => $this->spentToday,
            'spent_month' => $this->spentMonth,
            'credit_card_open_total' => $this->creditCardOpenTotal,
            'credit_card_limit_used' => $this->creditCardLimitUsed,
        ];
    }
}
