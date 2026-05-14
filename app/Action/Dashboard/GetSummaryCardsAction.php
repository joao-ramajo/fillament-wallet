<?php

declare(strict_types=1);

namespace App\Action\Dashboard;

use App\DTO\Dashboard\GetSummaryCardsInput;
use App\DTO\Dashboard\GetSummaryCardsOutput;
use App\Enum\DashboardSummaryCard;
use App\Models\User;
use App\Support\Logging\FormatsLogMessage;
use Psr\Log\LoggerInterface;

class GetSummaryCardsAction
{
    use FormatsLogMessage;

    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    public function execute(GetSummaryCardsInput $input): GetSummaryCardsOutput
    {
        $this->logger->info($this->formatLogMessage('started'), [
            'user_id' => $input->userId,
        ]);

        $user = User::query()->find($input->userId);
        $cardIds = $user?->dashboard_summary_cards;

        if ($cardIds === null || ! DashboardSummaryCard::isValidSelection($cardIds)) {
            $cardIds = DashboardSummaryCard::defaultSelection();
        }

        $this->logger->info($this->formatLogMessage('completed'), [
            'user_id' => $input->userId,
            'card_ids' => $cardIds,
        ]);

        return new GetSummaryCardsOutput($cardIds);
    }
}
