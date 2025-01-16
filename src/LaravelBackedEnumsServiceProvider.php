<?php

namespace Webfox\LaravelBackedEnums;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelBackedEnumsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-backed-enums')
            ->hasConfigFile();

        $package->withCommands([
            LaravelBackedEnumMakeCommand::class,
        ]);
    }
}
