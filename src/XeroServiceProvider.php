<?php

namespace MacsiDigital\Xero;

use Illuminate\Support\ServiceProvider;

class XeroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('xero.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'xero');

        // Register the main class to use with the facade
        $this->app->singleton('xero', function () {
            return new Xero;
        });
    }
}
