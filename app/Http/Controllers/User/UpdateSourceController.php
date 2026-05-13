<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Action\Source\UpdateSourceAction;
use App\DTO\Source\UpdateSourceInput;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateSourceRequest;
use App\Support\Logging\FormatsLogMessage;
use DomainException;
use Illuminate\Http\JsonResponse;
use Psr\Log\LoggerInterface;

class UpdateSourceController extends Controller
{
    use FormatsLogMessage;

    public function __construct(
        private readonly UpdateSourceAction $updateSourceAction,
        private readonly LoggerInterface $logger,
    ) {}

    public function __invoke(UpdateSourceRequest $request, int $id): JsonResponse
    {
        try {
            $userId = $this->authenticatedUserId();
            /** @var array{
             *     name: string,
             *     color: string,
             *     allow_negative?: bool,
             *     credit_limit?: int|null,
             *     statement_closing_day?: int|null,
             *     statement_due_day?: int|null
             * } $validated
             */
            $validated = $request->validated();

            $this->logger->info($this->formatLogMessage('request received'), [
                'user_id' => $userId,
                'source_id' => $id,
                'name' => $validated['name'],
            ]);

            $input = new UpdateSourceInput(
                id: $id,
                userId: $userId,
                name: $validated['name'],
                color: $validated['color'],
                allowNegative: $validated['allow_negative'] ?? false,
                creditLimit: $validated['credit_limit'] ?? null,
                statementClosingDay: $validated['statement_closing_day'] ?? null,
                statementDueDay: $validated['statement_due_day'] ?? null,
            );

            $output = $this->updateSourceAction->execute($input);

            return response()->json($output->toArray(), 200);
        } catch (DomainException $domainException) {
            return response()->json([
                'message' => $domainException->getMessage(),
            ], 400);
        }
    }
}
