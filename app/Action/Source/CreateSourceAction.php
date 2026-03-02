<?php

declare(strict_types=1);

namespace App\Action\Source;

use App\DTO\Source\CreateSourceInput;
use App\DTO\Source\CreateSourceOutput;
use App\Models\Source;
use App\Support\Logging\FormatsLogMessage;
use Psr\Log\LoggerInterface;

class CreateSourceAction
{
    use FormatsLogMessage;

    public function __construct(
        private readonly LoggerInterface $logger,
    ) {
    }

    public function execute(CreateSourceInput $input): CreateSourceOutput
    {
        $this->logger->info($this->formatLogMessage('started'), [
            'user_id' => $input->userId,
            'name' => $input->name,
            'allow_negative' => $input->allowNegative,
        ]);

        $source = Source::create([
            'user_id' => $input->userId,
            'name' => $input->name,
            'color' => $input->color,
            'allow_negative' => $input->allowNegative,
            'is_default' => false,
        ]);

        $this->logger->info($this->formatLogMessage('completed'), [
            'user_id' => $input->userId,
            'source_id' => $source->id,
        ]);

        return new CreateSourceOutput('Fonte criada com sucesso', $source);
    }
}
