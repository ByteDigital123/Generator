<?php

namespace App\Console\Commands\Boilerplate;

use Illuminate\Console\Command;

class GenerateProviderAppConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:provider-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get a list of service providers to put in config app.php';

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

        foreach (glob("./app/Models/*.php") as $file) {
            $model = basename($file, '.php');

            if (!in_array($model, config('scaffold.legacyModels'))) {
                $this->info('App\Providers\\' . env('APP_NAME') . '\\' . $model . 'ServiceProvider::class,');
            }
        }

    }
}
