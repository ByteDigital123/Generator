<?php

namespace Bytedigital123\Generator\src\Console\Commands;

use Illuminate\Console\Command;

class GeneratorProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Generator:project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generator the project';

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

        $location = $this->choice('Which namespace shall we save them under?', config('Generator.areas'));

        foreach (glob('./' . config('Generator.models') . '/*.php') as $file) {
            $model = basename($file, '.php');

            if (!in_array($model, config('Generator.legacyModels'))) {

                $this->call('Generator:single', [
                    'model' => $model,
                    'location' => $location,
                ]);
            }
        }


        if ($this->confirm('Next you will see a list of policy providers to add to the AuthServiceProvider.php, do you wish to continue?')) {
            $this->call('Generator:policy-list');
        };

        $this->info('Completed');

    }

}
