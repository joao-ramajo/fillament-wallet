<?php

declare(strict_types=1);

namespace App\DTO\Dashboard;

readonly class GetSummaryCardsOutput
{
    /**
     * @param  array<int, string>  $cardIds
     */
    public function __construct(
        public array $cardIds,
    ) {}

    /**
     * @return array{card_ids: array<int, string>}
     */
    public function toArray(): array
    {
        return [
            'card_ids' => $this->cardIds,
        ];
    }
}
