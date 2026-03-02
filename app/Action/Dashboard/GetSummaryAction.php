<?php

declare(strict_types=1);

namespace App\Action\Dashboard;

use App\DTO\Dashboard\GetSummaryInput;
use App\DTO\Dashboard\GetSummaryOutput;
use App\Models\Expense;
use App\Support\Logging\FormatsLogMessage;
use Psr\Log\LoggerInterface;

class GetSummaryAction
{
    use FormatsLogMessage;

    public function __construct(
        private readonly LoggerInterface $logger,
    ) {
    }

    public function execute(GetSummaryInput $input): GetSummaryOutput
    {
        $this->logger->info($this->formatLogMessage('started'), [
            'user_id' => $input->userId,
            'default_source_id' => $input->defaultSourceId,
        ]);

        $startedAt = microtime(true);

        $totalReceive = Expense::where('user_id', $input->userId)
            ->where('type', 'income')
            ->where('status', 'paid')
            ->where('source_id', $input->defaultSourceId)
            ->sum('amount');

        $totalExpense = Expense::where('user_id', $input->userId)
            ->where('type', 'expense')
            ->where('status', 'paid')
            ->where('source_id', $input->defaultSourceId)
            ->sum('amount');

        $totalIncomePending = Expense::where('user_id', $input->userId)
            ->where('type', 'income')
            ->where('status', 'pending')
            ->where('source_id', $input->defaultSourceId)
            ->sum('amount');

        $totalExpensePending = Expense::where('user_id', $input->userId)
            ->where('type', 'expense')
            ->where('status', 'pending')
            ->where('source_id', $input->defaultSourceId)
            ->sum('amount');

        $expectedTotal = ($totalReceive + $totalIncomePending) - ($totalExpense + $totalExpensePending);

        $this->logger->info($this->formatLogMessage('completed'), [
            'user_id' => $input->userId,
            'total_receive' => $totalReceive,
            'total_expense' => $totalExpense,
            'expected_total' => $expectedTotal,
            'query_time_ms' => (int) ((microtime(true) - $startedAt) * 1000),
        ]);

        return new GetSummaryOutput((int) $totalReceive, (int) $totalExpense, (int) $expectedTotal);
    }
}
