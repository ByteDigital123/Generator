<?php

namespace Bytedigital123\Generator\Console\Commands;

use Illuminate\Console\Command;

class GeneratorSingle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator:single {model} {location}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generator files for given model';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // 1. create controllers

        $model = $this->argument('model');
        $location = $this->argument('location');

        // remove the files before remaking them
        $this->deleteFiles($model, $location);

        \Artisan::call('generator:controller', [
            'name' => $model . "Controller",
            '--model' => $model,
            '--location' => $location,
        ]);

        // 2. create resources
        \Artisan::call('make:resource', [
            'name' => $location . "\\" . $model . "\\" . $model . "Resource",
        ]);

        \Artisan::call('make:resource', [
            'name' => $location . "\\" . $model . "\\" . $model . "Collection",
        ]);

        // 3. create requests
        try {

            \Artisan::call('make:request', [
                'name' => $location . "\\" . $model . "\Store" . $model . "Request",
            ]);

            \Artisan::call('make:request', [
                'name' => $location . "\\" . $model . "\Update" . $model . "Request",
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

//        // 4. create repositories
//        \Artisan::call('generator:interface', [
//            'name' => $model . "Interface",
//            '--model' => $model,
//        ]);
//
//        // call Create Repository
//        \Artisan::call('generator:repository', [
//            'name' => "\Eloquent" . $model . "Repository",
//            '--model' => $model,
//        ]);

//        // Call Create ServiceProvider
//        \Artisan::call('generator:serviceProvider', [
//            'name' => $model . "ServiceProvider",
//            '--model' => $model,
//        ]);

        // Call Create Search
        \Artisan::call('generator:search', [
            'name' => $model . "Search",
            '--model' => $model,
            '--location' => $location,
        ]);

        \Artisan::call('generator:policy', [
            'name' => $model . "Policy",
            '--model' => $model,
            '--location' => $location,
        ]);

//        \Artisan::call('make:factory', [
//            'name' => $model . "Factory",
//        ]);

        \Artisan::call('generator:service', [
            'name' => $model . 'Service',
            '--model' => $model,
        ]);

//        \Artisan::call('generator:provider', [
//            'name' => $model . 'ServiceProvider',
//            '--model' => $model,
//        ]);

        try {
            $this->call('generator:permission', [
                'model' => $model,
                'location' => $location,
            ]);

        } catch (\Exception $e) {

        }

    }

    /**
     * delete the setup files if they exists
     *
     * @param string $model
     * @param string $location
     * @return void
     */
    protected function deleteFiles($model, $location): void
    {
        // controllers
        $this->deleteFile(app_path() . '/Http/Controllers/' . $location . '/' . $model . 'Controller.php');

        // services
        $this->deleteFile(app_path() . '/Services/' . $model . 'Service.php');

        // Search Service
        $this->deleteFile(app_path() . '/Http/SearchFilters/' . $location . '/' . $model . '/' . $model . 'Search.php');

        // Policies
        $this->deleteFile(app_path() . '/Policies/' . $location . '/' . $model . 'Policy.php');

    }

    protected function deleteFile($file)
    {
        if (file_exists($file)) {
            return unlink($file);
        }
        return false;
    }
}
