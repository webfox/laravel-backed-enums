<?php

use Illuminate\Support\Facades\File;
use function Pest\Laravel\artisan;

it('can create an enum', function () {
    artisan('make:enum TestEnum -s')
        ->execute();
    expect(base_path('app/TestEnum.php'))->toBeFile();
});

it('can make pure enum', function () {
    artisan('make:enum PureEnum')
        ->execute();

    expect(base_path('app/PureEnum.php'))->toBeFile();

    $expectedContents = File::get(__DIR__ . '/Fixtures/ExpectedPureEnum.php');
    $actualContents   = File::get(base_path('app/PureEnum.php'));

    expect($actualContents)->toEqual($expectedContents);
});

it('can make string enum', function () {

    artisan('make:enum StringEnum --string --force')
        ->execute();


    expect(base_path('app/StringEnum.php'))->toBeFile();

    $expectedContents = File::get(__DIR__ . '/Fixtures/ExpectedStringEnum.php');
    $actualContents   = File::get(base_path('app/StringEnum.php'));

    expect($actualContents)->toEqual($expectedContents);
});

it('can make int enum', function () {

    artisan('make:enum IntEnum --int --force')
        ->execute();

    expect(base_path('app/IntEnum.php'))->toBeFile();

    $expectedContents = File::get(__DIR__ . '/Fixtures/ExpectedIntEnum.php');
    $actualContents   = File::get(base_path('app/IntEnum.php'));

    expect($actualContents)->toEqual($expectedContents);
});
