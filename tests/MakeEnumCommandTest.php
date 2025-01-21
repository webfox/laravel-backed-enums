<?php

use Illuminate\Support\Facades\File;
use function Pest\Laravel\artisan;
use function Orchestra\Testbench\workbench_path;

it('can create an enum', function () {
    if (File::exists(workbench_path('app/Enums/TestEnum.php'))) {
        File::delete(workbench_path('app/Enums/TestEnum.php'));
    }
    artisan('make:enum TestEnum -s')
        ->execute();

    expect(workbench_path('app/Enums/TestEnum.php'))->toBeFile();
})
    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    ->skip(!class_exists(\Illuminate\Foundation\Console\EnumMakeCommand::class), "Laravel 11 only");

it('can make pure enum', function () {

    if (File::exists(workbench_path('app/Enums/PureEnum.php'))) {
        File::delete(workbench_path('app/Enums/PureEnum.php'));
    }

    artisan('make:enum PureEnum')
        ->execute();

    expect(workbench_path('app/Enums/PureEnum.php'))->toBeFile();

    $expectedContents = File::get(__DIR__ . '/Fixtures/ExpectedPureEnum.php');
    $actualContents   = File::get(workbench_path('app/Enums/PureEnum.php'));

    expect($actualContents)->toEqual($expectedContents);
})
    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    ->skip(!class_exists(\Illuminate\Foundation\Console\EnumMakeCommand::class), "Laravel 11 only");

it('can make string enum', function () {

    if (File::exists(workbench_path('app/Enums/StringEnum.php'))) {
        File::delete(workbench_path('app/Enums/StringEnum.php'));
    }

    artisan('make:enum StringEnum --string')
        ->execute();

    expect(workbench_path('app/Enums/StringEnum.php'))->toBeFile();

    $expectedContents = File::get(__DIR__ . '/Fixtures/ExpectedStringEnum.php');
    $actualContents   = File::get(workbench_path('app/Enums/StringEnum.php'));

    expect($actualContents)->toEqual($expectedContents);
})
    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    ->skip(!class_exists(\Illuminate\Foundation\Console\EnumMakeCommand::class), "Laravel 11 only");

it('can make int enum', function () {

    if (File::exists(workbench_path('app/Enums/IntEnum.php'))) {
        File::delete(workbench_path('app/Enums/IntEnum.php'));
    }

    artisan('make:enum IntEnum --int')
        ->execute();

    expect(workbench_path('app/Enums/IntEnum.php'))->toBeFile();

    $expectedContents = File::get(__DIR__ . '/Fixtures/ExpectedIntEnum.php');
    $actualContents   = File::get(workbench_path('app/Enums/IntEnum.php'));

    expect($actualContents)->toEqual($expectedContents);
})
    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    ->skip(!class_exists(\Illuminate\Foundation\Console\EnumMakeCommand::class), "Laravel 11 only");
