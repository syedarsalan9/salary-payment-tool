<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class ExportServiceProvider extends ServiceProvider
{
    public function register() {
        $this->app->singleton(FileExportFactory::class, function ($app) {
            return new FileExportFactory();
        });
    }
}
