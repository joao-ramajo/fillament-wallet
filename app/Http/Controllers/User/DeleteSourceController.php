<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Action\Source\DeleteSourceAction;
use App\Http\Controllers\Controller;
use DomainException;
use Illuminate\Http\JsonResponse;

class DeleteSourceController extends Controller
{
    public function __construct(
        private readonly DeleteSourceAction $deleteSourceAction,
    ) {}

    public function __invoke(string $id): JsonResponse
    {
        try {
            $this->deleteSourceAction->execute(
                (int) $id,
                $this->authenticatedUserId()
            );

            return response()->json([
                'message' => 'Fonte excluída com sucesso.',
            ]);
        } catch (DomainException $domainException) {
            return response()->json([
                'message' => $domainException->getMessage(),
            ], 400);
        }
    }
}
