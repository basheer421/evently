<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // composer require --dev barryvdh/laravel-ide-helper
        // composer require --dev doctrine/dbal
        // php artisan ide-helper:generate
        // php artisan ide-helper:models -M
        // php artisan ide-helper:meta

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
