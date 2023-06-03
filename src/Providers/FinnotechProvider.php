<?php

namespace Tedon\LaravelFinnotech\Providers;

use Illuminate\Support\ServiceProvider;
use Tedon\LaravelFinnotech\Finnotech;

class FinnotechProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('finnotech', function () {
            return new Finnotech();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
