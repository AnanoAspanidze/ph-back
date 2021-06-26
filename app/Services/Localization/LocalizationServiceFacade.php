<?php

namespace App\Services\Localization;

use Illuminate\Support\Facades\Facade;

class LocalizationServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'LocalizationService';
    }
}