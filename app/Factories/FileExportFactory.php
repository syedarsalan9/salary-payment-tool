<?php

namespace App\Factories;

use App\Contracts\FileExportInterface;
use App\Services\FileExport\CSVExportService;
use App\Services\FileExport\ExcelExportService;
use Exception;

class FileExportFactory
{
    protected $csvExportService;
    protected $excelExportService;

    public function __construct(
        CSVExportService $csvExportService, // Injecting services
        ExcelExportService $excelExportService
    ) {
        $this->csvExportService = $csvExportService;
        $this->excelExportService = $excelExportService;
    }

    public function create(string $format): FileExportInterface
    {
        switch ($format) {
            case 'csv':
                return $this->csvExportService;
            case 'xlsx':
                return $this->excelExportService;
            default:
                throw new Exception("Unsupported file format: {$format}");
        }
    }
}
