<?php

declare(strict_types=1);

namespace App\Action\Xlsx;

use App\Domain\Interfaces\XlsxSheet;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ExpensesListSheet implements XlsxSheet
{
    private const HEADER_RANGE = 'A1:G1';
    private const HEADER_ROW_HEIGHT = 32;
    private const DATA_ROW_HEIGHT = 18;

    public function addTo(Spreadsheet $spreadsheet): void
    {
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Despesas');

        $rawData = $this->getValues();
        $data = $this->normalizeValues($rawData);

        $this->setupHeaders($sheet);
        $this->setupColumnWidths($sheet);
        $this->insertData($sheet, $data);

        $lastRow = count($data) + 1;

        $this->setupRowHeights($sheet, $lastRow);
        $this->applyHeaderStyles($sheet);
        $this->applyColumnAlignments($sheet, $lastRow);
        $this->applyConditionalFormatting($sheet, $rawData);
        $this->freezeHeader($sheet);
    }

    private function getUserId(): int
    {
        return app()->environment() === 'local' ? 1 : Auth::id();
    }

    private function setupHeaders($sheet): void
    {
        $headers = $this->getHeaders();
        $sheet->fromArray([$headers], null, 'A1');
    }

    private function setupColumnWidths($sheet): void
    {
        $widths = [
            'A' => 35, // Descrição
            'B' => 18, // Valor
            'C' => 16, // Status
            'D' => 24, // Categoria
            'E' => 16, // Tipo
            'F' => 24, // Fonte
            'G' => 20, // Data
        ];

        foreach ($widths as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }
    }

    private function insertData($sheet, array $data): void
    {
        $sheet->fromArray($data, null, 'A2');
    }

    private function setupRowHeights($sheet, int $lastRow): void
    {
        // Cabeçalho
        $sheet->getRowDimension(1)->setRowHeight(self::HEADER_ROW_HEIGHT);

        // Linhas de dados
        for ($i = 2; $i <= $lastRow; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(self::DATA_ROW_HEIGHT);
        }
    }

    private function applyHeaderStyles($sheet): void
    {
        $sheet->getStyle(self::HEADER_RANGE)->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
                'color' => ['rgb' => '1F2937'],
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
    }

    private function applyColumnAlignments($sheet, int $lastRow): void
    {
        $this->applyDescriptionAlignment($sheet, $lastRow);
        $this->applyValueAlignment($sheet, $lastRow);
        $this->applyStatusAlignment($sheet, $lastRow);
        $this->applyCategoryAlignment($sheet, $lastRow);
        $this->applyTypeAlignment($sheet, $lastRow);
        $this->applySourceAlignment($sheet, $lastRow);
        $this->applyDateAlignment($sheet, $lastRow);
    }

    private function applyDescriptionAlignment($sheet, int $lastRow): void
    {
        $sheet->getStyle("A2:A{$lastRow}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);
    }

    private function applyValueAlignment($sheet, int $lastRow): void
    {
        $sheet->getStyle("B2:B{$lastRow}")->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
            ],
            'font' => [
                'bold' => true,
                'size' => 10,
            ],
        ]);
    }

    private function applyStatusAlignment($sheet, int $lastRow): void
    {
        $sheet->getStyle("C2:C{$lastRow}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

    private function applyCategoryAlignment($sheet, int $lastRow): void
    {
        $sheet->getStyle("D2:D{$lastRow}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);
    }

    private function applyTypeAlignment($sheet, int $lastRow): void
    {
        $sheet->getStyle("E2:E{$lastRow}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

    private function applySourceAlignment($sheet, int $lastRow): void
    {
        $sheet->getStyle("F2:F{$lastRow}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);
    }

    private function applyDateAlignment($sheet, int $lastRow): void
    {
        $sheet->getStyle("G2:G{$lastRow}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

    private function applyConditionalFormatting($sheet, array $rawData): void
    {
        foreach ($rawData as $index => $row) {
            $rowNum = $index + 2;

            $this->formatStatus($sheet, $rowNum, $row['status']);
            $this->formatType($sheet, $rowNum, $row['type']);
        }
    }

    private function formatStatus($sheet, int $rowNum, string $status): void
    {
        if ($status === 'paid') {
            $sheet->getStyle("C{$rowNum}")->applyFromArray([
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => '10B981'], // verde
                ],
            ]);
        } elseif ($status === 'pending') {
            $sheet->getStyle("C{$rowNum}")->applyFromArray([
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'F59E0B'], // laranja
                ],
            ]);
        }
    }

    private function formatType($sheet, int $rowNum, string $type): void
    {
        if ($type === 'income') {
            $this->formatAsIncome($sheet, $rowNum);
        } elseif ($type === 'expense') {
            $this->formatAsExpense($sheet, $rowNum);
        }
    }

    private function formatAsIncome($sheet, int $rowNum): void
    {
        // Coluna Tipo
        $sheet->getStyle("E{$rowNum}")->applyFromArray([
            'font' => [
                'color' => ['rgb' => '3B82F6'], // azul
            ],
        ]);

        // Coluna Valor
        $sheet->getStyle("B{$rowNum}")->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '3B82F6'], // azul
            ],
        ]);
    }

    private function formatAsExpense($sheet, int $rowNum): void
    {
        // Coluna Tipo
        $sheet->getStyle("E{$rowNum}")->applyFromArray([
            'font' => [
                'color' => ['rgb' => 'EF4444'], // vermelho
            ],
        ]);
    }

    private function freezeHeader($sheet): void
    {
        $sheet->freezePane('A2');
    }

    private function getHeaders(): array
    {
        return [
            'Descrição',
            'Valor',
            'Status',
            'Categoria',
            'Tipo',
            'Fonte',
            'Data de Pagamento'
        ];
    }

    private function getValues(): array
    {
        return Expense::query()
            ->where('expenses.user_id', $this->getUserId())
            ->leftJoin('categories', 'expenses.category_id', '=', 'categories.id')
            ->leftJoin('sources', 'sources.id', '=', 'expenses.source_id')
            ->select(
                'expenses.title',
                'expenses.amount',
                'expenses.status',
                'categories.name as category',
                'expenses.type',
                'sources.name as source',
                'expenses.payment_date'
            )
            ->get()
            ->toArray();
    }

    private function normalizeValues(array $values): array
    {
        return array_map(function ($row) {
            return [
                $row['title'],
                $this->formatMoney($row['amount']),
                $this->translateStatus($row['status']),
                $row['category'] ?? '-',
                $this->translateType($row['type']),
                $row['source'] ?? '-',
                $this->formatDate($row['payment_date'])
            ];
        }, $values);
    }

    private function formatMoney($amount): string
    {
        return 'R$ ' . number_format(((int) $amount) / 100, 2, ',', '.');
    }

    private function formatDate(?string $date): string
    {
        return $date ? Carbon::parse($date)->format('d/m/Y') : '-';
    }

    private function translateStatus(string $status): string
    {
        return match ($status) {
            'paid' => 'Pago',
            'pending' => 'Pendente',
            default => ucfirst($status),
        };
    }

    private function translateType(string $type): string
    {
        return match ($type) {
            'income' => 'Receita',
            'expense' => 'Despesa',
            default => ucfirst($type),
        };
    }
}
