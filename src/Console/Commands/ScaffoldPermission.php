<?php

namespace App\Console\Commands\Boilerplate;

use Illuminate\Console\Command;
use App\Services\PermissionService;

class ScaffoldPermission extends Command
{
    protected $permissionService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:permission {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold the default list of permissions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PermissionService $permissionService)
    {
        parent::__construct();
        $this->permissionService = $permissionService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('creating the standard permissions for ' . $this->argument('model'));
        $this->permissionService->createStaticPermissions($this->argument('model'));
    }
}
