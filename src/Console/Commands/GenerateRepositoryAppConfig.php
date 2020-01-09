<?php

namespace Bytedigital123\Scaffold\Console\Commands;

use Illuminate\Console\Command;

class GenerateRepositoryAppConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:repository-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get a list of service providers for the repositories';

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
                $this->info('App\Repositories\\' . $model . '\\' . $model . 'ServiceProvider::class,');
            }
        }

    }
}