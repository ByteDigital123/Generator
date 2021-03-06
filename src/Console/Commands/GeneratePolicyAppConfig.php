<?php

namespace Bytedigital123\Generator\Console\Commands;

use Illuminate\Console\Command;

class GeneratePolicyAppConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Generator:policy-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get a list of policies for the auth provider';

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
        foreach (glob('./' . config('generator.models') . '/*.php') as $file) {
            $model = basename($file, '.php');

            if (!in_array($model, config('generator.legacyModels'))) {
                $this->info('App\Models\\' . $model . '::class =>  App\Policies\Api\\' . $model . 'Policy::class,');
            }
        }

    }
}
