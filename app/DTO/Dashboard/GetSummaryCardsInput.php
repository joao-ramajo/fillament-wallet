<?php

declare(strict_types=1);

namespace App\DTO\Dashboard;

readonly class GetSummaryCardsInput
{
    public function __construct(
        public int $userId,
    ) {}
}
