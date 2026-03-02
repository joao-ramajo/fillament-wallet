<?php

declare(strict_types=1);

namespace App\Action\Dashboard;

use App\DTO\Dashboard\GetExpensesInput;
use App\DTO\Dashboard\GetExpensesOutput;
use App\Support\Logging\FormatsLogMessage;
use Illuminate\Support\Facades\DB;
use Psr\Log\LoggerInterface;

class GetExpensesAction
{
    use FormatsLogMessage;

    public function __construct(
        private readonly LoggerInterface $logger,
    ) {
    }

    public function execute(GetExpensesInput $input): GetExpensesOutput
    {
        $this->logger->info($this->formatLogMessage('started'), [
            'user_id' => $input->userId,
            'status_filter' => $input->status,
        ]);

        $startedAt = microtime(true);

        $query = DB::table('expenses')
            ->leftJoin('categories', 'expenses.category_id', '=', 'categories.id')
            ->join('sources', 'expenses.source_id', '=', 'sources.id')
            ->where('expenses.user_id', $input->userId);

        if ($input->status !== null && $input->status !== 'all') {
            $query->where('expenses.status', $input->status);
        }

        $expenses = $query
            ->orderBy('expenses.created_at', 'desc')
            ->select(
                'expenses.id',
                'expenses.title',
                'categories.name as category',
                'categories.id as category_id',
                'expenses.amount',
                'expenses.payment_date',
                'expenses.due_date',
                'expenses.type',
                'expenses.status',
                'expenses.source_id',
                'sources.name as source_name',
            )
            ->get()
            ->toArray();

        $this->logger->info($this->formatLogMessage('completed'), [
            'user_id' => $input->userId,
            'count' => count($expenses),
            'query_time_ms' => (int) ((microtime(true) - $startedAt) * 1000),
        ]);

        return new GetExpensesOutput($expenses);
    }
}
