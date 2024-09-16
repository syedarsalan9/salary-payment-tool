<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Binding FileExportFactory to the container
        $this->app->bind(FileExportFactory::class, function ($app) {
            return new FileExportFactory(
                $app->make(\App\Services\FileExport\CSVExportService::class),
                $app->make(\App\Services\FileExport\ExcelExportService::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
