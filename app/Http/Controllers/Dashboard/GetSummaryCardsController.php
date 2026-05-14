<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Action\Dashboard\GetSummaryCardsAction;
use App\DTO\Dashboard\GetSummaryCardsInput;
use App\Http\Controllers\Controller;
use App\Support\Logging\FormatsLogMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;

class GetSummaryCardsController extends Controller
{
    use FormatsLogMessage;

    public function __construct(
        private readonly GetSummaryCardsAction $getSummaryCardsAction,
        private readonly LoggerInterface $logger,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $userId = $this->authenticatedUserId();

        $this->logger->info($this->formatLogMessage('request received'), [
            'user_id' => $userId,
        ]);

        $output = $this->getSummaryCardsAction->execute(
            new GetSummaryCardsInput($userId)
        );

        return response()->json($output->toArray(), 200);
    }
}
