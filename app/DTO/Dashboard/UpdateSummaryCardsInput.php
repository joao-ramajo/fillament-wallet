<?php

declare(strict_types=1);

namespace App\DTO\Dashboard;

readonly class UpdateSummaryCardsInput
{
    /**
     * @param  array<int, string>  $cardIds
     */
    public function __construct(
        public int $userId,
        public array $cardIds,
    ) {}
}
