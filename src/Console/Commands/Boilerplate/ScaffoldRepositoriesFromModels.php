<?php

namespace App\Console\Commands\Boilerplate;

use Illuminate\Console\Command;

class ScaffoldRepositoriesFromModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:repository:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all repository files for the models';

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
        $currentFiles = [
            'AdminUser',
            'Permission',
            'PermissionGroup',
            'Role'
        ];


        // run through each model
        foreach (glob("./app/*.php") as $file) {
            $filename = basename($file, '.php');

            if (! in_array($filename, $currentFiles)) {

                // call Create Interface
                \Artisan::call('make:interface', [
                    'name' => $filename . "Interface",
                    '--model' => $filename
                ]);


                // call Create Repository
                \Artisan::call('make:repository', [
                    'name' => "\Eloquent" . $filename . "Repository",
                    '--model' => $filename
                ]);
                
                // Call Create ServiceProvider
                \Artisan::call('make:serviceProvider', [
                    'name' => $filename . "ServiceProvider",
                    '--model' => $filename
                ]);
            }
        }
    }
}
