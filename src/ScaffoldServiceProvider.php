<?php

namespace Bytedigital123\Scaffold;

use Illuminate\Support\ServiceProvider;
use Bytedigital123\Scaffold\Console\Commands\ScaffoldProject;

class ScaffoldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'scaffold');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'scaffold');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('scaffold.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/scaffold'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/scaffold'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/scaffold'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([
                ScaffoldProject::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'scaffold');

        // Register the main class to use with the facade
        $this->app->singleton('scaffold', function () {
            return new Scaffold;
        });
    }
}
