<?php

namespace Workbench\App\Providers;

use Illuminate\Support\Facades\Lang;
use Illuminate\Translation\Translator;
use Illuminate\Support\ServiceProvider;

class WorkbenchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Lang::setLocale('en');
    }
}
