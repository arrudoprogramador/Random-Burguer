<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
    public function boot()
    {
        if (
            app()->environment('production') ||
            env('APP_ENV') === 'production' ||
            str_contains(request()->header('host', ''), 'onrender.com') ||
            str_contains(request()->header('host', ''), 'render.com') ||
            request()->header('x-forwarded-proto') === 'https'
        ) {
            URL::forceScheme('https');
        }
    }
}
