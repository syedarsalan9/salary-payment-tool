<?php

namespace App\Services\FileExport;

use App\Contracts\FileExportInterface;
use Illuminate\Support\Facades\Storage;

class CSVExportService implements FileExportInterface
{
    public function export(array $data, string $year): string
    {
        $filename = "salary_payment_{$year}.csv";  // Ab filename simple rakhte hain

        // Open a temporary memory stream instead of directly writing to disk
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, ['Month', 'Salary Payment Date', 'Bonus Payment Date']);

        foreach ($data as $row) {
            fputcsv($handle, $row);
        }

        // Rewind the stream to the beginning
        rewind($handle);

        // Read the data from the stream into a variable
        $csvData = stream_get_contents($handle);
        fclose($handle);

        // Store the file using the Storage facade
        Storage::disk('local')->put($filename, $csvData);  // 'local' ko 's3' ya kisi aur disk se replace kar sakte hain

        return Storage::disk('local')->path($filename);  // File ka path return kar rahe hain
    }
}
