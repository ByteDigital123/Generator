<?php

namespace App\Console\Commands\Boilerplate;

use Illuminate\Console\Command;

class ScaffoldControllerFromModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:controller:model {--location}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the controller command for all models in app';

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
                // call Create controller
                \Artisan::call('create:controller', [
                    'name' => $filename . "Controller",
                    '--model' => $filename,
                    '--location' => $this->option('location')
                ]);
            }
        }
    }
}
