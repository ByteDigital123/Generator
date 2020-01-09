<?php

namespace App\Console\Commands\Boilerplate;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;

class ScaffoldServiceProvider extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'scaffold:serviceProvider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Repository Service Provider';

    protected $type = "Service Provider";

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return './app/Console/stubs/RepoServiceProvider.stub';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_REQUIRED, 'Generate a repository for the given model.'],
            ['location', 'l', InputOption::VALUE_REQUIRED, 'Specify the location for the namespace']
        ];
    }

    public function getArguments()
    {
        return [
            ['name', InputOption::VALUE_REQUIRED, 'Name of the controller'],
        ];
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $replace = [];

        if ($this->option('model')) {
            $replace = $this->buildModelReplacements($replace);
        }

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }

    /**
    * Build the replacement values.
    *
    * @param array $replace
    *
    * @return array
    */
    protected function buildModelReplacements(array $replace)
    {
        $modelClass = $this->parseModel($this->option('model'));

        return array_merge($replace, [
            'DummyFullModelClass' => $modelClass,
            'DummyModelClass'     => class_basename($modelClass),
            'DummyInterface'      => class_basename($modelClass) . 'Interface',
            'DummyClass'          => class_basename($modelClass) . 'RoleRepoServiceProvider',
            'DummyFullInterface'  => 'App\Repositories\\' . class_basename($modelClass) . '\\' . class_basename($modelClass) . 'Interface',
            'DummyFullRepository' => 'App\Repositories\\' . class_basename($modelClass) . '\Eloquent' . class_basename($modelClass) . 'Repository',
        ]);
    }

    /**
     * Get the fully qualified class name.
     *
     * @param string $model
     *
     * @return string
     */
    protected function parseModel($model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\', $model), '\\');
        
        if (! Str::startsWith($model, $rootNamespace = $this->laravel->getNamespace())) {
            $model = $rootNamespace . $model;
        }
        
        return $model;
    }

    /**
    * Get the default namespace for the class.
    *
    * @param string $rootNamespace
    *
    * @return string
    */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories\\' . $this->option('model') ;
    }
}
