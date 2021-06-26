<?php

namespace App\Http\Controllers\Localization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;

class LocalizationController extends Controller
{
    protected $previousRequest;
    protected $locale;

    public function switch($locale)
    {
        $this->previousRequest = $this->getPreviousRequest();
        $this->locale = $locale;

        // Store the segments of the last request as an array
        $segments = $this->previousRequest->segments();

        // Check if the first segment matches a language code
        if (array_key_exists($this->locale, config('languages'))) {
            // Replace the first segment by the new language code
            $segments[0] = $this->locale;
            // Redirect to the required URL
            return redirect()->to($this->buildNewRoute($segments));
        }

        return back();
    }

    protected function getPreviousRequest()
    {
        // We Transform the URL on which the user was into a Request instance
        return request()->create(url()->previous());
    }

    protected function buildNewRoute($newRoute)
    {
        $redirectUrl = implode('/', $newRoute);
        // Get Query Parameters if any, so they are preserved
        $queryBag = $this->previousRequest->query();
        $redirectUrl .= count($queryBag) ? '?' . http_build_query($queryBag) : '';

        return $redirectUrl;
    }
}
