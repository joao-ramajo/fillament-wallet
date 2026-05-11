<?php

declare(strict_types=1);

namespace App\Strategy;

interface ExportStrategyInterface
{
    public function execute();

    public function generate(int $userId);
}
