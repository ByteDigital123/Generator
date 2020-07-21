<?php

namespace Bytedigital123\Generator\src\Console\Commands;

use Symfony\Component\Console\Input\InputOption;
use InvalidArgumentException;
use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;

class GeneratorService extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'Generator:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a New Service';

    protected $type = "Service";

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return './vendor/bytedigital123/Generator/src/Console/stubs/Service.stub';
    }

    public function getArguments()
    {
        return [
            ['name', InputOption::VALUE_REQUIRED, 'Name of the controller'],
        ];
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

        $replace = $this->buildModelReplacements($replace);

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
            '{{MODEL}}' => class_basename($modelClass),
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
        return $rootNamespace . '\Services';
    }
}
