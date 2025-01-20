<?php

namespace Webfox\LaravelBackedEnums;

use InvalidArgumentException;
use Illuminate\Foundation\Console\EnumMakeCommand;


class LaravelBackedEnumMakeCommand extends EnumMakeCommand
{
    protected $description = 'Create a new laravel backed enum';

    protected function getStub(): string
    {
        if ($this->option('string') || $this->option('int')) {
            return $this->resolveStubPath('/stubs/laravel-backed-enum.stub');
        }
        return parent::getStub();
    }

    protected function resolveStubPath($stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . "/../" . $stub;
    }

    protected function getNameInput(): string
    {
        $name = trim($this->argument('name'));
        if (!preg_match('/^[A-Za-z_\x7f-\xff][A-Za-z0-9_\x7f-\xff]*$/', $name)) {
            throw new InvalidArgumentException('Invalid enum name format');
        }

        if (str_ends_with($name, 'Enum')) {
            return $name;
        }

        return $name . 'Enum';
    }
}
