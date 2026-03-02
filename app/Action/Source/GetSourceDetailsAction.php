<?php

declare(strict_types=1);

namespace App\Action\Source;

use App\DTO\Source\GetSourceDetailsInput;
use App\DTO\Source\GetSourceDetailsOutput;
use App\Models\Expense;
use App\Models\Source;
use App\Support\Logging\FormatsLogMessage;
use Psr\Log\LoggerInterface;

class GetSourceDetailsAction
{
    use FormatsLogMessage;

    public function __construct(
        private readonly LoggerInterface $logger,
    ) {
    }

    public function execute(GetSourceDetailsInput $input): GetSourceDetailsOutput
    {
        $this->logger->info($this->formatLogMessage('started'), [
            'user_id' => $input->userId,
        ]);

        $startedAt = microtime(true);
        $sources = Source::where('user_id', $input->userId)->get();

        $items = $sources->map(function (Source $source) use ($input) {
            $totalIncome = Expense::where('user_id', $input->userId)
                ->where('source_id', $source->id)
                ->where('type', 'income')
                ->sum('amount');

            $totalExpense = Expense::where('user_id', $input->userId)
                ->where('source_id', $source->id)
                ->where('type', 'expense')
                ->sum('amount');

            $expensesCount = Expense::where('user_id', $input->userId)
                ->where('source_id', $source->id)
                ->count();

            return [
                'id' => $source->id,
                'name' => $source->name,
                'color' => $source->color,
                'expenses_count' => $expensesCount,
                'total_income' => $totalIncome,
                'total_expense' => $totalExpense,
                'balance' => $totalIncome - $totalExpense,
            ];
        })->values()->all();

        $this->logger->info($this->formatLogMessage('completed'), [
            'user_id' => $input->userId,
            'count' => count($items),
            'query_time_ms' => (int) ((microtime(true) - $startedAt) * 1000),
        ]);

        return new GetSourceDetailsOutput($items);
    }
}
