<?php

namespace Bytedigital123\pixel-boilerplate;

use Illuminate\Support\ServiceProvider;
use Bytedigital123\pixel-boilerplate\Scaffold;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldSingle;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldService;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldResourceFromModel;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldRequestFromModel;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldRepository;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldRepositoriesFromModels;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldProvider;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldProject;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldPolicy;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldPermission;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldNewServiceProvider;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldModelSearch;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldInterface;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldControllerFromModels;
use Bytedigital123\pixel-boilerplate\Console\Commands\ScaffoldController;
use Bytedigital123\pixel-boilerplate\Console\Commands\GenerateRepositoryAppConfig;
use Bytedigital123\pixel-boilerplate\Console\Commands\GenerateProviderAppConfig;
use Bytedigital123\pixel-boilerplate\Console\Commands\GeneratePolicyAppConfig;

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
                GeneratePolicyAppConfig::class,
                GenerateProviderAppConfig::class,
                GenerateRepositoryAppConfig::class,
                ScaffoldController::class,
                ScaffoldControllerFromModels::class,
                ScaffoldInterface::class,
                ScaffoldModelSearch::class,
                ScaffoldPermission::class,
                ScaffoldPolicy::class,
                ScaffoldProvider::class,
                ScaffoldRepositoriesFromModels::class,
                ScaffoldRepository::class,
                ScaffoldRequestFromModel::class,
                ScaffoldResourceFromModel::class,
                ScaffoldService::class,
                ScaffoldNewServiceProvider::class,
                ScaffoldSingle::class,
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
