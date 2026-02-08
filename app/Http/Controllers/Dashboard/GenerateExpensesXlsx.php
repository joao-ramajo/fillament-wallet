<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Action\Xlsx\ExpensesListSheet;
use App\Action\Xlsx\SourcesSummarySheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class GenerateExpensesXlsx
{
    public function __construct(
        private readonly ExpensesListSheet $expensesListSheet,
        private readonly SourcesSummarySheet $sourcesSummarySheet
    ) {
    }

    public function __invoke()
    {
        $spreadsheet = new Spreadsheet();

        $this->expensesListSheet->addTo($spreadsheet);
        $this->sourcesSummarySheet->addTo($spreadsheet);

        return $this->generateResponse($spreadsheet);
    }

    private function generateResponse(Spreadsheet $spreadsheet): StreamedResponse
    {
        $response = new StreamedResponse(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        });

        $response->headers->set(
            'Content-Type',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        $response->headers->set(
            'Content-Disposition',
            'attachment;filename="despesas.xlsx"'
        );
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }
}
