<?php

declare(strict_types=1);

namespace App\Services;

use App\Strategy\CsvExportStrategy;
use App\Strategy\XlsxExportStrategy;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportService
{
    public function execute(Request $request): StreamedResponse
    {
        $type = $request->string('type')->toString();
        $strategy = match ($type) {
            'xlsx' => resolve(XlsxExportStrategy::class),
            default => resolve(CsvExportStrategy::class),
        };

        return $strategy->execute();
    }
}
