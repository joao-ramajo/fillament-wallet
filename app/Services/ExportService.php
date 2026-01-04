<?php

namespace App\Services;

use App\Strategy\CsvExportStrategy;
use App\Strategy\XlsxExportStrategy;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportService
{
    public function execute(Request $request): StreamedResponse
    {
        $mapper = [
            'csv' => CsvExportStrategy::class,
            'xlsx' => XlsxExportStrategy::class
        ];

        $type = $request->get('type');

        $final = app($mapper[$type]) ?? null;

        if(!$final){
            throw new \Exception('Tipo de exportação ainda não implementado.');
        }

        return $final->execute();
    }
}
