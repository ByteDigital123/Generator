<?php

namespace Bytedigital123\Generator\Console\Commands;

use Symfony\Component\Console\Input\InputOption;
use InvalidArgumentException;
use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;

class GeneratorController extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generator:controller';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $type = "Controller";

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $locationOption = $this->option('location');
        if ($locationOption == 'Api') {
            return './vendor/bytedigital123/Generator/src/Console/stubs/ApiController.stub';
        }

        return './vendor/bytedigital123/Generator/src/Console/stubs/Controller.stub';
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
            ['location', 'l', InputOption::VALUE_REQUIRED, 'Specify the location for the namespace'],
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
            'DummyModelClass' => class_basename($modelClass),
            'DummyService' => class_basename($modelClass) . 'Service',
            'DummyTest' => class_basename($modelClass) . 'Controller',
            'DummyResource' => class_basename($modelClass) . 'Resource',
            'DummyUpdateRequest' => 'Update' . class_basename($modelClass) . 'Request',
            'DummyStoreRequest' => 'Store' . class_basename($modelClass) . 'Request',
            'Location' => $this->option('location'),
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

        if (!Str::startsWith($model, $rootNamespace = $this->laravel->getNamespace())) {
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
        return $rootNamespace . '\Http\Controllers\\' . $this->option('location');
    }
}
