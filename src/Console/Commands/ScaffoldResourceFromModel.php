<?php

namespace App\Console\Commands\Boilerplate;

use Illuminate\Console\Command;

class ScaffoldResourceFromModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:create:model {--location}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the resource files from the model';

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


        foreach (glob("./app/*.php") as $file) {
            $filename = basename($file, '.php');

            if (! in_array($filename, $currentFiles)) {
                \Artisan::call('make:resource', [
                    'name' => $this->option('location') . "\\"  . $filename . "\\" . $filename . "Resource"
                ]);

                \Artisan::call('make:resource', [
                    'name' => $this->option('location') . "\\"  . $filename . "\\" . $filename . "Collection"
                ]);
            }
        }
    }
}
