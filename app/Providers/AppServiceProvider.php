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
        try {
            if (
                config('app.env') === 'production' ||
                env('APP_ENV') === 'production' ||
                (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
                (isset($_SERVER['HTTP_HOST']) && str_contains($_SERVER['HTTP_HOST'], 'onrender.com')) ||
                (isset($_SERVER['HTTP_HOST']) && str_contains($_SERVER['HTTP_HOST'], 'render.com'))
            ) {
                URL::forceScheme('https');
            }
        } catch (\Throwable $e) {
            // Silently fall back to avoid crashing during boot/CLI
        }
    }
}
