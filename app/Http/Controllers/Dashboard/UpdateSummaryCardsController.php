<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Action\Dashboard\UpdateSummaryCardsAction;
use App\DTO\Dashboard\UpdateSummaryCardsInput;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdateSummaryCardsRequest;
use App\Support\Logging\FormatsLogMessage;
use Illuminate\Http\JsonResponse;
use Psr\Log\LoggerInterface;

class UpdateSummaryCardsController extends Controller
{
    use FormatsLogMessage;

    public function __construct(
        private readonly UpdateSummaryCardsAction $updateSummaryCardsAction,
        private readonly LoggerInterface $logger,
    ) {}

    public function __invoke(UpdateSummaryCardsRequest $request): JsonResponse
    {
        $userId = $this->authenticatedUserId();
        /** @var array<int, string> $cardIds */
        $cardIds = $request->validated('card_ids');

        $this->logger->info($this->formatLogMessage('request received'), [
            'user_id' => $userId,
            'card_ids' => $cardIds,
        ]);

        $output = $this->updateSummaryCardsAction->execute(
            new UpdateSummaryCardsInput($userId, $cardIds)
        );

        return response()->json([
            'message' => 'Cards do dashboard salvos com sucesso.',
            ...$output->toArray(),
        ], 200);
    }
}
