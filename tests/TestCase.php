<?php

namespace Webfox\LaravelBackedEnums\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Webfox\LaravelBackedEnums\LaravelBackedEnumsServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelBackedEnumsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {

    }
}
