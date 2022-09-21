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

### Setup your enum

The enum you create must implement the `BackedEnum` interface and also use the `IsBackedEnum` trait.
The interface is required for Laravel to cast your enum correctly and the trait is what gives your enum its superpowers.

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
     VolumeUnitEnum::class => [
        VolumeUnitEnum::MILLIGRAMS->value => "mg",
        VolumeUnitEnum::GRAMS->value      => "g",
        VolumeUnitEnum::KILOGRAMS->value  => "kg",
        VolumeUnitEnum::TONNE->value      => "t"
     ]
];
```

You may then access these localized values using the `->label()` or `::labelFor()` methods

```php
VolumeUnitEnum::MILLIGRAMS->label(); // "mg"
VolumeUnitEnum::labelFor(VolumeUnitEnum::TONNE); // "t"
```

If you do not specify a label in the lang file these methods will return the value assigned to the enum inside the enum file. e.g MILLIGRAMS label will be MILLIGRAMS

### Meta data

Adding metadata allows you to return additional values alongside the label and values.

Create a withMeta method on your enum to add metadata.

```php
public function withMeta(): array
{
    return match ($this) {
        self::MILLIGRAMS                => [
            'background_color' => 'bg-green-100',
            'text_color'       => 'text-green-800',
        ],
        self::GRAMS                     => [
            'background_color' => 'bg-red-100',
            'text_color'       => 'text-red-800',
        ],
        self::KILOGRAMS, self::TONNE    => [
            'background_color' => 'bg-gray-100',
            'text_color'       => 'text-gray-800',
        ],
        default                         => [
            'background_color' => 'bg-blue-100',
            'text_color'       => 'text-blue-800',
        ],
    };
}
```

If you do not specify a `withMeta` method, meta will be an empty array.

## Other methods

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
        'name'  => 'MILLIGRAMS'
        'value' => 'MILLIGRAMS',
        'label' => 'mg',
        'meta'  => [
            'background_color' => 'bg-green-100',
            'text_color'       => 'text-green-800',
        ],
    ],
    [
        'name'  => 'GRAMS',
        'value' => 'GRAMS',
        'label' => 'g',
        'meta'  => [
            'background_color' => 'bg-red-100',
            'text_color'       => 'text-red-800',
        ],
        ...
    ]
]
```

### names

Returns an array of all enum values.

#### Usage

```php
VolumeUnitEnum::names();
```

returns

```php
[
    'MILLIGRAMS',
    'GRAMS',
    'KILOGRAMS',
    'TONNE',
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
    'MILLIGRAMS',
    'GRAMS',
    'KILOGRAMS',
    'TONNE',
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

### map

Returns an array of all enum values mapping to their label.

#### Usage

```php
VolumeUnitEnum::map();
```

returns

```php
[
    'MILLIGRAMS'=>'mg',
    'GRAMS'     =>'g',
    'KILOGRAMS' =>'kg',
    'TONNE'    =>'t',
]
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
    'name'  => 'MILLIGRAMS'
    'value' => 'MILLIGRAMS',
    'label' => 'mg',
    'meta'  => [
        'color' => 'bg-green-100',
        'text_color' => 'text-green-800',
    ],
]
```

### toJson

An alias for toArray.

### isA/isAn

Allows you to check if an enum is a given value. Returns a boolean.
> **Note**
> `isAn` is just an alias for `isA`.

#### Usage

```php
VolumeUnitEnum::MILLIGRAMS->isA(VolumeUnitEnum::GRAMS); //false
VolumeUnitEnum::MILLIGRAMS->isA(VolumeUnitEnum::MILLIGRAMS); //true
```

### isNotA/isNotAn

Allows you to check if an enum is not a given value. Returns a boolean.
> **Note**
> `isNotAn` is just an alias for `isNotA`.

#### Usage

```php
VolumeUnitEnum::MILLIGRAMS->isA(VolumeUnitEnum::GRAMS); //true
VolumeUnitEnum::MILLIGRAMS->isA(VolumeUnitEnum::MILLIGRAMS); //false
```

### isAny

Allows you to check if an enum is contained in an array. Returns a boolean.

#### Usage

```php
VolumeUnitEnum::MILLIGRAMS->isAny([VolumeUnitEnum::GRAMS, VolumeUnitEnum::TONNE]); // false
VolumeUnitEnum::MILLIGRAMS->isAny([VolumeUnitEnum::GRAMS, VolumeUnitEnum::MILLIGRAMS]); // true
```

### isNotAny

Allows you to check if an enum is not contained in an array. Returns a boolean.

#### Usage

```php
VolumeUnitEnum::MILLIGRAMS->isAny([VolumeUnitEnum::GRAMS, VolumeUnitEnum::TONNE]); // true
VolumeUnitEnum::MILLIGRAMS->isAny([VolumeUnitEnum::GRAMS, VolumeUnitEnum::MILLIGRAMS]); // false
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

We welcome all contributors to the project.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
