# Package for using PHP 8.1 backed enums in laravel.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/webfox/laravel-backed-enums.svg?style=flat-square)](https://packagist.org/packages/webfox/laravel-backed-enums)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/webfox/laravel-backed-enums/run-tests?label=tests)](https://github.com/webfox/laravel-backed-enums/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/webfox/laravel-backed-enums/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/webfox/laravel-backed-enums/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/webfox/laravel-backed-enums.svg?style=flat-square)](https://packagist.org/packages/webfox/laravel-backed-enums)

This package supercharges your PHP8 backed enums with superpowers like localization support and fluent comparison methods.

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
                'background_color' => 'bg-green-100',
                'text_color' => 'text-green-800',
            ],
            self::GRAMS                     => [
                'background_color' => 'bg-red-100',
                'text_color' => 'text-red-800',
            ],
            self::KILOGRAMS, self::TONNE    => [
                'background_color' => 'bg-gray-100',
                'text_color' => 'text-gray-800',
            ],
            default                         => throw new \Exception('Unexpected match value'),
        };
    }
```

## Other functions

### options

Returns an array of all enum values with their labels and metadata.

#### Usage

```php
VolumeUnitEnum::options();
```

returns

```php
[
    [
        'value' => 'Milligrams',
        'label' => 'mg',
        'meta'  => [
            'background_color' => 'bg-green-100',
            'text_color' => 'text-green-800',
        ],
    ],
    [
        'value' => 'Grams',
        'label' => 'g',
        'meta'  => [
            'background_color' => 'bg-red-100',
            'text_color' => 'text-red-800',
        ],
        ...
    ]
]
```

### values

Returns an array of all enum values.

#### Usage

```php
VolumeUnitEnum::values();
```

returns

```php
[
    'Milligrams',
    'Grams',
    'Kilograms',
    'Tonne',
]
```

### labels

Returns an array of all enum labels.

#### Usage

```php
VolumeUnitEnum::labels();
```

returns

```php
[
    'mg',
    'g',
    'kg',
    't',
]
```

### labelFor

Returns the label for a given enum name.

#### Usage

```php
VolumeUnitEnum::labelFor(VolumeUnitEnum::MILLIGRAMS);
```

returns

```php
'mg'
```

### label

Returns the label for the current enum.

#### Usage

```php
VolumeUnitEnum::MILLIGRAMS->label();
```

returns

```php
'mg'
```


### toArray

Returns an array of a single enum value with its label and metadata.

#### Usage

```php
VolumeUnitEnum::MILLIGRAMS->toArray();
```

returns

```php
[
    'value' => 'Milligrams',
    'label' => 'mg',
    'meta'  => [
        'color' => 'bg-green-100',
        'text_color' => 'text-green-800',
    ],
]
```

### toJson

An alias for toArray.

### isA
Allows you to check if an enum is a given value. Returns a boolean.

#### Usage

```php
VolumeUnitEnum::MILLIGRAMS->isA(VolumeUnitEnum::GRAMS);
```

#### Negation
The negated method also exists. Being isNot


### isAn
Alias for isA.

### isAny
Allows you to check if an enum is contained in an array. Returns a boolean.

#### Usage

```php
VolumeUnitEnum::MILLIGRAMS->isAny([VolumeUnitEnum::GRAMS, VolumeUnitEnum::TONNE]);
```

#### Negation
The negated method also exists. Being isNotAny

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

We welcome all contributors to the project.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
