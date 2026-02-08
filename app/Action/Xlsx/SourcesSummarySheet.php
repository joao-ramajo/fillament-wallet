<?php

declare(strict_types=1);

namespace App\Action\Xlsx;

use App\Domain\Interfaces\XlsxSheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SourcesSummarySheet implements XlsxSheet
{
    public function addTo(Spreadsheet $spreadsheet): void
    {
        $sheet = new Worksheet($spreadsheet, 'Resumo por Fonte');
        $spreadsheet->addSheet($sheet);

        $this->setupHeaders($sheet);

        $rawData = $this->getValues();
        $data = $this->normalizeValues($rawData);

        $sheet->fromArray($data, null, 'A2');

        $lastRow = count($data) + 1;
        $totalRow = $lastRow;

        $sheet->getStyle("A{$totalRow}:D{$totalRow}")->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E5E7EB'], // cinza claro
            ],
        ]);

        $this->setupColumnWidths($sheet);
        $this->applyHeaderStyles($sheet);
        $this->applyRowStyles($sheet, $lastRow);
        $this->freezeHeader($sheet);
    }

    private function getUserId(): int
    {
        return app()->environment() === 'local' ? 1 : Auth::id();
    }

    private function setupHeaders(Worksheet $sheet): void
    {
        $sheet->fromArray([
            ['Fonte', 'Total Recebido', 'Total Gasto', 'Saldo']
        ], null, 'A1');
    }

    private function setupColumnWidths(Worksheet $sheet): void
    {
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(18);
        $sheet->getColumnDimension('C')->setWidth(18);
        $sheet->getColumnDimension('D')->setWidth(18);
    }

    private function getValues(): array
    {
        return DB::table('expenses')
            ->leftJoin('sources', 'sources.id', '=', 'expenses.source_id')
            ->where('expenses.user_id', $this->getUserId())
            ->selectRaw('
                sources.name as source,
                SUM(CASE WHEN expenses.type = "income" THEN expenses.amount ELSE 0 END) as total_income,
                SUM(CASE WHEN expenses.type = "expense" THEN expenses.amount ELSE 0 END) as total_expense
            ')
            ->groupBy('sources.name')
            ->get()
            ->toArray();
    }

    private function normalizeValues(array $values): array
    {
        $totalIncome = 0;
        $totalExpense = 0;

        $rows = array_map(function ($row) use (&$totalIncome, &$totalExpense) {
            $income = (int) $row->total_income;
            $expense = (int) $row->total_expense;

            $totalIncome += $income;
            $totalExpense += $expense;

            return [
            $row->source ?? '—',
            $this->formatMoney($income),
            $this->formatMoney($expense),
            $this->formatMoney($income - $expense),
            ];
        }, $values);

        // Linha de total
        $rows[] = [
        'TOTAL',
        $this->formatMoney($totalIncome),
        $this->formatMoney($totalExpense),
        $this->formatMoney($totalIncome - $totalExpense),
        ];

        return $rows;
    }


    private function applyHeaderStyles(Worksheet $sheet): void
    {
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'DBEAFE'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(32);
    }

    private function applyRowStyles(Worksheet $sheet, int $lastRow): void
    {
        for ($i = 2; $i <= $lastRow; $i++) {
            $sheet->getStyle("A{$i}:D{$i}")
                ->getAlignment()
                ->setVertical(Alignment::VERTICAL_CENTER);

            $sheet->getStyle("B{$i}:D{$i}")
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);
        }
    }

    private function freezeHeader(Worksheet $sheet): void
    {
        $sheet->freezePane('A2');
    }

    private function formatMoney(int|string $amount): string
    {
        return 'R$ ' . number_format((int) $amount / 100, 2, ',', '.');
    }
}
