<?php

declare(strict_types=1);

namespace App\Enum;

enum DashboardSummaryCard: string
{
    case TotalReceive = 'total_receive';
    case TotalExpense = 'total_expense';
    case ExpectedTotal = 'expected_total';
    case TotalReceive30Days = 'total_receive_30_days';
    case TotalExpense30Days = 'total_expense_30_days';
    case CurrentBalance = 'current_balance';
    case ExpectedExpenses = 'expected_expenses';
    case TotalExpensePending = 'total_expense_pending';
    case CreditCardOpenTotal = 'credit_card_open_total';
    case CreditCardLimitUsed = 'credit_card_limit_used';
    case SpentToday = 'spent_today';
    case SpentMonth = 'spent_month';
    case FinalBalance = 'final_balance';

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_map(
            static fn (self $card): string => $card->value,
            self::cases(),
        );
    }

    /**
     * @return list<string>
     */
    public static function defaultSelection(): array
    {
        return [
            self::TotalReceive30Days->value,
            self::TotalExpense30Days->value,
            self::ExpectedTotal->value,
        ];
    }

    /**
     * @param  array<int, string>  $selection
     */
    public static function isValidSelection(array $selection): bool
    {
        return count($selection) === 3
            && count(array_unique($selection)) === 3
            && array_reduce(
                $selection,
                static fn (bool $carry, string $card): bool => $carry && in_array($card, self::values(), true),
                true,
            );
    }
}
