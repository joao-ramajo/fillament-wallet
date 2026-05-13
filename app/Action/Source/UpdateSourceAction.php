<?php

declare(strict_types=1);

namespace App\Action\Source;

use App\DTO\Source\UpdateSourceInput;
use App\DTO\Source\UpdateSourceOutput;
use App\Models\Source;
use App\Support\Logging\FormatsLogMessage;
use DomainException;
use Psr\Log\LoggerInterface;

class UpdateSourceAction
{
    use FormatsLogMessage;

    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    public function execute(UpdateSourceInput $input): UpdateSourceOutput
    {
        $this->logger->info($this->formatLogMessage('started'), [
            'user_id' => $input->userId,
            'source_id' => $input->id,
            'name' => $input->name,
        ]);

        $source = Source::query()->findOrFail($input->id);

        if ($source->user_id !== $input->userId) {
            $this->logger->warning($this->formatLogMessage('forbidden update attempt'), [
                'user_id' => $input->userId,
                'source_id' => $input->id,
                'owner_id' => $source->user_id,
            ]);
            throw new DomainException('Você não pode alterar esta fonte.');
        }

        if ($source->is_default) {
            $this->logger->warning($this->formatLogMessage('default source update attempt'), [
                'user_id' => $input->userId,
                'source_id' => $input->id,
            ]);
            throw new DomainException('A fonte principal não pode ser editada.');
        }

        $updates = [
            'name' => $input->name,
            'color' => $input->color,
        ];

        if ($source->isCreditCard()) {
            $updates['allow_negative'] = false;
            $updates['credit_limit'] = $input->creditLimit;
            $updates['statement_closing_day'] = $input->statementClosingDay;
            $updates['statement_due_day'] = $input->statementDueDay;
        } else {
            $updates['allow_negative'] = $input->allowNegative;
            $updates['credit_limit'] = null;
            $updates['statement_closing_day'] = null;
            $updates['statement_due_day'] = null;
        }

        $source->update($updates);

        $this->logger->info($this->formatLogMessage('completed'), [
            'user_id' => $input->userId,
            'source_id' => $source->id,
        ]);

        return new UpdateSourceOutput('Fonte atualizada com sucesso', $source->refresh());
    }
}
