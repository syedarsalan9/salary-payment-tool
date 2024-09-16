<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\FileExport\CSVExportService;

class CSVExportServiceTest extends TestCase
{
    /** @test */
    public function it_can_export_data_to_csv_file()
    {
        // Arrange: Test data
        $data = [
            ['month' => 'January', 'salary_date' => '2024-01-31', 'bonus_date' => '2024-01-15'],
            ['month' => 'February', 'salary_date' => '2024-02-28', 'bonus_date' => '2024-02-15'],
        ];
        $year = '2024';

        // Act: Create CSV file
        $csvService = new CSVExportService();
        $filePath = $csvService->export($data, $year);

        // Assert: Check if the file is created
        $this->assertFileExists($filePath);

        // Assert: Read file content
        $fileContent = file_get_contents($filePath);
        $this->assertStringContainsString('January,2024-01-31,2024-01-15', $fileContent);
        $this->assertStringContainsString('February,2024-02-28,2024-02-15', $fileContent);

        // Clean up
        unlink($filePath);
    }
}
