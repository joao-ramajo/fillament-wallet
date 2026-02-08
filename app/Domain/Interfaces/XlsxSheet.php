<?php

namespace App\Domain\Interfaces;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

interface XlsxSheet
{
    public function addTo(Spreadsheet $spreadsheet): void;
}
