<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LocalizationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("LocalizationService", 'App\Services\Localization\LocalizationService');
    }
}
