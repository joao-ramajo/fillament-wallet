<?php

declare(strict_types=1);

namespace App\Action\Source;

use App\Models\Source;
use DomainException;

class DeleteSourceAction
{
    public function execute(int $sourceId, int $userId): void
    {
        $source = Source::query()->find($sourceId);

        throw_if($source === null, DomainException::class, 'Fonte não encontrada.');

        throw_if($source->user_id !== $userId, DomainException::class, 'Você não tem permissão para excluir esta fonte.');

        throw_if($source->is_default, DomainException::class, 'A fonte principal não pode ser excluída.');

        $source->delete();
    }
}
