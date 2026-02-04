<?php

namespace App\Strategy;

interface ExportStrategyInterface
{
    public function execute();

    public function generate(int $userId);
}
