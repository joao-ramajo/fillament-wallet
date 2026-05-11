<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Strategy\CsvExportStrategy;
use Symfony\Component\HttpFoundation\StreamedResponse;

class GenerateExpenseCsv
{
    public function __construct(
        protected readonly CsvExportStrategy $csvExport
    ) {}

    public function __invoke(): StreamedResponse
    {
        return $this->csvExport->execute();
    }
}
