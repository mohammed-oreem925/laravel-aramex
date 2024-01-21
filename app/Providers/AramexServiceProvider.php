<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AramexServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../database/migrations/' => database_path('migrations'),
        ], 'migrations/Aramex');
        $this->publishes([
            __DIR__ . '/../../config/aramex.php' => config_path('aramex.php'),
        ], 'config');
    }
}
