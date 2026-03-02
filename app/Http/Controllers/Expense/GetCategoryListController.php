<?php

namespace App\Http\Controllers\Expense;

use App\Action\Category\GetCategoryListAction;
use App\DTO\Category\GetCategoryListInput;
use App\Http\Controllers\Controller;
use App\Support\Logging\FormatsLogMessage;
use Illuminate\Support\Facades\Auth;
use Psr\Log\LoggerInterface;

class GetCategoryListController extends Controller
{
    use FormatsLogMessage;

    public function __construct(
        private readonly GetCategoryListAction $getCategoryListAction,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function __invoke()
    {
        $userId = Auth::id();
        $this->logger->info($this->formatLogMessage('request received'), [
            'user_id' => $userId,
        ]);

        $output = $this->getCategoryListAction->execute(
            new GetCategoryListInput($userId)
        );

        return response()->json($output->toArray());
    }
}
