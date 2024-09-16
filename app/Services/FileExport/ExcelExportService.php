<?php

namespace App\Services\FileExport;

use App\Contracts\FileExportInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;

class ExcelExportService implements FileExportInterface
{
    public function export(array $data, string $year): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header row
        $sheet->setCellValue('A1', 'Month')
              ->setCellValue('B1', 'Salary Payment Date')
              ->setCellValue('C1', 'Bonus Payment Date');

        // Set data rows
        $rowNumber = 2;
        foreach ($data as $row) {
            $sheet->setCellValue("A{$rowNumber}", $row['month'])
                  ->setCellValue("B{$rowNumber}", $row['salary_date'])
                  ->setCellValue("C{$rowNumber}", $row['bonus_date']);
            $rowNumber++;
        }

        // Save the file to a temporary memory stream
        $tempFile = 'php://temp';
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // Store the file using Laravel's Storage facade
        $filename = "salary_payment_{$year}.xlsx";
        Storage::disk('local')->put($filename, file_get_contents($tempFile));

        return Storage::disk('local')->path($filename);  // File ka path return karte hain
    }
}
