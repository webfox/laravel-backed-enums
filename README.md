# Package for using PHP 8.1 backed enums in laravel.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/webfox/laravel-backed-enums.svg?style=flat-square)](https://packagist.org/packages/webfox/laravel-backed-enums)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/webfox/laravel-backed-enums/run-tests?label=tests)](https://github.com/webfox/laravel-backed-enums/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/webfox/laravel-backed-enums/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/webfox/laravel-backed-enums/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/webfox/laravel-backed-enums.svg?style=flat-square)](https://packagist.org/packages/webfox/laravel-backed-enums)

This package provides a trait that contains functions useful for adding labels to your backed enums.

## Installation

```bash
composer require webfox/laravel-backed-enums
```

## Usage

### Using the trait

The enum you create must implement BackedEnum, this interface allows the toArray and toJson functions from within IsBackEnum to be called on your
enum.

```php
use Webfox\LaravelBackedEnums\BackedEnum;
use Webfox\LaravelBackedEnums\IsBackedEnum;

enum VolumeUnitEnum: string implements BackedEnum
{
    use IsBackedEnum;

    case MILLIGRAMS = "MILLIGRAMS";
    case GRAMS = "GRAMS";
    case KILOGRAMS = "KILOGRAMS";
    case TONNE = "TONNE";
}
```

### Enum value labels (Localization)

Create enums.php lang file and create labels for your enum values.

```php
// resources/lang/en/enums.php

return [
     VolumeUnitEnum::class          => [
        VolumeUnitEnum::MILLIGRAMS->name => "mg",
        VolumeUnitEnum::GRAMS->name      => "g",
        VolumeUnitEnum::KILOGRAMS->name  => "kg",
        VolumeUnitEnum::TONNE->name      => "t"
     ]
];
```

### Meta data

Adding metadata allows you to return additional values alongside the label and values.

Create a withMeta function on your enum to add metadata.

```php
public function withMeta(): array
    {
        return match ($this) {
            self::MILLIGRAMS                => [
                'color' => 'bg-green-100',
                'text_color' => 'text-green-800',
            ],
            self::GRAMS                     => [
                'color' => 'bg-red-100',
                'text_color' => 'text-red-800',
            ],
            self::KILOGRAMS, self::TONNE    => [
                'color' => 'bg-gray-100',
                'text_color' => 'text-gray-800',
            ],
            default                         => throw new \Exception('Unexpected match value'),
        };
    }
```

### Other functions

```php
->isA(VolumeUnitEnum::MILLIGRAMS)
->isAn [alias for isA]
->isAny([VolumeUnitEnum::MILLIGRAMS, VolumeUnitEnum::GRAMS])

And their negations e.g.
->isNot(VolumeUnitEnum::MILLIGRAMS)
->isNotAny([VolumeUnitEnum::MILLIGRAMS, VolumeUnitEnum::GRAMS])
```

