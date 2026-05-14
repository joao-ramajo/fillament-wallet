<?php

declare(strict_types=1);

namespace App\Action\Dashboard;

use App\DTO\Dashboard\UpdateSummaryCardsInput;
use App\DTO\Dashboard\UpdateSummaryCardsOutput;
use App\Enum\DashboardSummaryCard;
use App\Models\User;
use App\Support\Logging\FormatsLogMessage;
use Psr\Log\LoggerInterface;

class UpdateSummaryCardsAction
{
    use FormatsLogMessage;

    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    public function execute(UpdateSummaryCardsInput $input): UpdateSummaryCardsOutput
    {
        $this->logger->info($this->formatLogMessage('started'), [
            'user_id' => $input->userId,
            'card_ids' => $input->cardIds,
        ]);

        $cardIds = DashboardSummaryCard::isValidSelection($input->cardIds)
            ? array_values($input->cardIds)
            : DashboardSummaryCard::defaultSelection();

        $user = User::query()->findOrFail($input->userId);
        $user->update([
            'dashboard_summary_cards' => $cardIds,
        ]);

        $this->logger->info($this->formatLogMessage('completed'), [
            'user_id' => $input->userId,
            'card_ids' => $cardIds,
        ]);

        return new UpdateSummaryCardsOutput($cardIds);
    }
}
