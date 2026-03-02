<?php

declare(strict_types=1);

namespace App\DTO\Source;

readonly class CreateSourceInput
{
    public function __construct(
        public int $userId,
        public string $name,
        public string $color,
        public bool $allowNegative,
    ) {
    }
}
