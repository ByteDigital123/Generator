<?php

namespace App\Console\Commands\Boilerplate;

use Illuminate\Console\Command;

class ScaffoldProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold the project';

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

        $location = $this->choice('Which namespace shall we save them under?', config('scaffold.areas'));

        foreach (glob("./app/Models/*.php") as $file) {
            $model = basename($file, '.php');

            if (!in_array($model, config('scaffold.legacyModels'))) {

                $this->call('scaffold:single', [
                    'model' => $model,
                    'location' => $location,
                ]);
            }
        }

        if ($this->confirm('Next you will see a list of service providers to add to the app.php, do you wish to continue?')) {
            $this->call('scaffold:provider-list');
        };

        if ($this->confirm('Next you will see a list of repository providers to add to the app.php, do you wish to continue?')) {
            $this->call('scaffold:repository-list');
        };

        if ($this->confirm('Next you will see a list of policy providers to add to the AuthServiceProvider.php, do you wish to continue?')) {
            $this->call('scaffold:policy-list');
        };

        $this->info('Completed');

    }

}
