<?php

namespace App\Http\Controllers\User;

use App\Action\Source\CreateSourceAction;
use App\DTO\Source\CreateSourceInput;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateSourceRequest;
use App\Support\Logging\FormatsLogMessage;
use Illuminate\Support\Facades\Auth;
use Psr\Log\LoggerInterface;

class CreateSourceController extends Controller
{
    use FormatsLogMessage;

    public function __construct(
        private readonly CreateSourceAction $createSourceAction,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function __invoke(CreateSourceRequest $request)
    {
        $userId = Auth::id();
        $validated = $request->validated();

        $this->logger->info($this->formatLogMessage('request received'), [
            'user_id' => $userId,
            'name' => $validated['name'],
        ]);

        $input = new CreateSourceInput(
            userId: $userId,
            name: $validated['name'],
            color: $validated['color'],
            allowNegative: $validated['allow_negative'] ?? false,
        );

        $output = $this->createSourceAction->execute($input);

        return response()->json($output->toArray(), 201);
    }
}
