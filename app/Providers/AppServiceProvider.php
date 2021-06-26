<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        Schema::defaultstringLength(191);

        // Set the app locale according to the URL
        app()->setLocale($request->segment(1));

        $languages = \DB::table('languages')->where('active', true)->get();
        View::share('languages', $languages); 

        // highlightSearch
        Str::macro('highlightSearch', function ($input, $searchString) {
            return str_replace($searchString, "<span class='search__result__word'>$searchString</span>", $input); 
      });
    }
}
