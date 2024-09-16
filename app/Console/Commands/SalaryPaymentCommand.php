<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SalaryPaymentService;
use App\Factories\FileExportFactory;
use App\Services\ValidationService;
use Exception;

class SalaryPaymentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salary:generate {year} {format=csv}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate salary and bonus payment dates for a given year.';

    private $salaryService;
    private $fileExportFactory;
    private $validationService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        SalaryPaymentService $salaryService,
        FileExportFactory $fileExportFactory, // Injected via DI
        ValidationService $validationService  // Injected validation service
    ) {
        parent::__construct();
        $this->salaryService = $salaryService;
        $this->fileExportFactory = $fileExportFactory;
        $this->validationService = $validationService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $year = $this->argument('year');
        $format = $this->argument('format');

        try {
            $this->validationService->validateYear($year);
        } catch (Exception $e) {
            $this->error('Year validation failed: ' . $e->getMessage());
            return 1;
        }
        
        try {
            $dates = $this->salaryService->calculatePaymentDates($year);
        } catch (Exception $e) {
            $this->error('Error in calculating payment dates: ' . $e->getMessage());
            return 1;
        }
        
        try {
            $exporter = $this->fileExportFactory->create($format);
            $filePath = $exporter->export($dates, $year);
            $this->info("File generated successfully: {$filePath}");
        } catch (Exception $e) {
            $this->error('File export failed: ' . $e->getMessage());
        }
    }
}
