<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\UrlGenerator;

use App\Category;

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
    public function boot(UrlGenerator $url)
    {
        //
        //Schema::defaultStringLength(191);
        View::share('all_categories', Category::all());

        if (env('REDIRECT_HTTPS')) {
            $url->forceSchema('https');
        }
    }
}
