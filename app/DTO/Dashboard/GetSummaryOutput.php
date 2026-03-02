<?php

declare(strict_types=1);

namespace App\DTO\Dashboard;

readonly class GetSummaryOutput
{
    public function __construct(
        public int $totalReceive,
        public int $totalExpense,
        public int $expectedTotal,
    ) {
    }

    public function toArray(): array
    {
        return [
            'total_receive' => $this->totalReceive,
            'total_expense' => $this->totalExpense,
            'expected_total' => $this->expectedTotal,
        ];
    }
}
