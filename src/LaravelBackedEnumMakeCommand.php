<?php

namespace Webfox\LaravelBackedEnums;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Attribute\AsCommand;


#[AsCommand(name: 'make:laravel-backed-enum')]
class LaravelBackedEnumMakeCommand extends GeneratorCommand
{
    protected $signature = 'make:laravel-backed-enum {name} {enumType}';

    protected $description = 'Create a new laravel backed enum';

    protected $type = 'Enum';

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/laravel-backed-enum.stub');
    }

    protected function resolveStubPath($stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Enums';
    }

    protected function buildClass($name): array|string
    {
        $replace = [
            '{{ name }}'     => class_basename($name),
            '{{ enumType }}' => $this->argument('enumType'),
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }

    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'enumType' => [
                'What is the type of the enum?',
                match (strtolower($this->argument('enumType'))) {
                    'int'   => 'int',
                    default => 'string',
                },
            ],
            ...parent::promptForMissingArgumentsUsing(),
        ];
    }

    protected function getNameInput(): string
    {
        $name = trim($this->argument('name') . 'Enum');

        if (Str::endsWith($name, '.php')) {
            return Str::substr($name, 0, -4);
        }

        return $name;
    }
}
