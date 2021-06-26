<?php

namespace App\Services\Localization;

class LocalizationService 
{
    public function locale() {
        $locale = request()->segment(1, '');
        
        if($locale && array_key_exists($locale, config('languages'))) {
            return $locale;
        }

        return "";
    }
}