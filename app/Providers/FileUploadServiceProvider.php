<?php

namespace App\Providers;

use App\Services\FileUpload\FileUploadService;
use Illuminate\Support\ServiceProvider;

class FileUploadServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton("FileUploadService", function ($app) {
            return new FileUploadService();
        });
    }
}
