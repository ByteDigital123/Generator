<?php

namespace Bytedigital123\Generator;

use Illuminate\Support\ServiceProvider;
use Bytedigital123\Generator\Console\Commands\GeneratorSingle;
use Bytedigital123\Generator\Console\Commands\GeneratorService;
use Bytedigital123\Generator\Console\Commands\GeneratorResourceFromModel;
use Bytedigital123\Generator\Console\Commands\GeneratorRequestFromModel;
use Bytedigital123\Generator\Console\Commands\GeneratorRepository;
use Bytedigital123\Generator\Console\Commands\GeneratorRepositoriesFromModels;
use Bytedigital123\Generator\Console\Commands\GeneratorProvider;
use Bytedigital123\Generator\Console\Commands\GeneratorProject;
use Bytedigital123\Generator\Console\Commands\GeneratorPolicy;
use Bytedigital123\Generator\Console\Commands\GeneratorPermission;
use Bytedigital123\Generator\Console\Commands\GeneratorNewServiceProvider;
use Bytedigital123\Generator\Console\Commands\GeneratorModelSearch;
use Bytedigital123\Generator\Console\Commands\GeneratorControllerFromModels;
use Bytedigital123\Generator\Console\Commands\GeneratorController;
use Bytedigital123\Generator\Console\Commands\GeneratePolicyAppConfig;

class GeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'Generator');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'Generator');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('Generator.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/Generator'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/Generator'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/Generator'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([
                GeneratorProject::class,
                GeneratePolicyAppConfig::class,
                GeneratorController::class,
                GeneratorControllerFromModels::class,
                GeneratorModelSearch::class,
                GeneratorPermission::class,
                GeneratorPolicy::class,
                GeneratorProvider::class,
                GeneratorRepositoriesFromModels::class,
                GeneratorRepository::class,
                GeneratorRequestFromModel::class,
                GeneratorResourceFromModel::class,
                GeneratorService::class,
                GeneratorNewServiceProvider::class,
                GeneratorSingle::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'Generator');

        // Register the main class to use with the facade
        $this->app->singleton('Generator', function () {
            return new Generator;
        });
    }
}
