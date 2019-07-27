<?php

namespace MacsiDigital\Xero\Providers;

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
                __DIR__.'/../../config/config.php' => config_path('xero.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'xero');

        $this->app->singleton('xero', 'MacsiDigital\Xero\Xero');
        $this->app->bind('MacsiDigital\Xero\Contracts\Xero', 'MacsiDigital\Xero\Xero');
    }
}
