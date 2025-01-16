![Banner Image](https://banners.beyondco.de/Laravel%20Backed%20Enums.png?theme=light&packageManager=composer+require&packageName=webfox%2Flaravel-backed-enums&pattern=architect&style=style_1&description=Supercharge+your+PHP8+backed+enums+in+Laravel.&md=1&showWatermark=0&fontSize=125px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/webfox/laravel-backed-enums.svg?style=flat-square)](https://packagist.org/packages/webfox/laravel-backed-enums)
[![Total Downloads](https://img.shields.io/packagist/dt/webfox/laravel-backed-enums.svg?style=flat-square)](https://packagist.org/packages/webfox/laravel-backed-enums)

This package supercharges your PHP8 backed enums with superpowers like localization support and fluent comparison methods.

## Installation

```bash
composer require webfox/laravel-backed-enums
```

## Usage

### Make Command

You can use the `make:laravel-backed-enum` command to create a new enum.

```bash
php artisan make:laravel-backed-enum {name} {enumType}
```

This will create a new enum in the `app/Enums` directory.

The command takes in two arguments:

- name: The name of the enum
- enumType: The type of the enum. This can be either `string` or `int`. Default is `string`.

### Setup your enum

The enum you create must implement the `BackedEnum` interface and also use the `IsBackedEnum` trait.
The interface is required for Laravel to cast your enum correctly and the trait is what gives your enum its superpowers.

```php
use Webfox\LaravelBackedEnums\BackedEnum;
use Webfox\LaravelBackedEnums\IsBackedEnum;

enum VolumeUnitEnum: string implements BackedEnum
{
    use IsBackedEnum;

    case MILLIGRAMS = "milligrams";
    case GRAMS = "grams";
    case KILOGRAMS = "kilograms";
    case TONNE = "tonne";
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

You may then access these localized values using the `->label()` or `::labelFor()` methods.  
Additionally rendering the enum in a blade template will render the label.

```php
VolumeUnitEnum::MILLIGRAMS->label(); // "mg"
VolumeUnitEnum::labelFor(VolumeUnitEnum::TONNE); // "t"
// in blade
{{ VolumeUnitEnum::KILOGRAMS }} // "kg"
```

If you do not specify a label in the lang file these methods will return the value assigned to the enum inside the enum file. e.g MILLIGRAMS label will be milligrams.

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
        'name'  => 'MILLIGRAMS',
        'value' => 'milligrams',
        'label' => 'mg',
        'meta'  => [
            'background_color' => 'bg-green-100',
            'text_color'       => 'text-green-800',
        ],
    ],
    [
        'name'  => 'GRAMS',
        'value' => 'grams',
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
    'milligrams',
    'grams',
    'killograms',
    'tonne',
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
    'MILLIGRAMS' => 'mg',
    'GRAMS'      => 'g',
    'KILOGRAMS'  => 'kg',
    'TONNE'      => 't',
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
    'name'  => 'MILLIGRAMS',
    'value' => 'milligrams',
    'label' => 'mg',
    'meta'  => [
        'color'      => 'bg-green-100',
        'text_color' => 'text-green-800',
    ],
]
```

### toHtml

An alias of ::label(). Used to satisfy Laravel's Htmlable interface.

#### Usage

```php
VolumeUnitEnum::MILLIGRAMS->toHtml();
```

returns

```php
mg
```

### toJson

Returns a json string represention of the toArray return value.

### is/isA/isAn

Allows you to check if an enum is a given value. Returns a boolean.
> **Note**
> `isA`, `isAn` are just aliases for `is`.

#### Usage

```php
VolumeUnitEnum::MILLIGRAMS->is(VolumeUnitEnum::MILLIGRAMS); //true
VolumeUnitEnum::MILLIGRAMS->is('MILLIGRAMS');               //true
VolumeUnitEnum::MILLIGRAMS->is('invalid');                  //exception
```

### isNot/isNotA/isNotAn

Allows you to check if an enum is not a given value. Returns a boolean.
> **Note**
> `isNotA` and `isNotAn` are just aliases for `isNot`.

#### Usage

```php
VolumeUnitEnum::MILLIGRAMS->isNot(VolumeUnitEnum::GRAMS); //true
VolumeUnitEnum::MILLIGRAMS->isNot('GRAMS');               //true
VolumeUnitEnum::MILLIGRAMS->isNot('invalid');             //exception
```

### isAny

Allows you to check if an enum is contained in an array. Returns a boolean.

#### Usage

```php
VolumeUnitEnum::MILLIGRAMS->isAny(['GRAMS', VolumeUnitEnum::TONNE]);                    // false
VolumeUnitEnum::MILLIGRAMS->isAny([VolumeUnitEnum::GRAMS, VolumeUnitEnum::MILLIGRAMS]); // true
```

### isNotAny

Allows you to check if an enum is not contained in an array. Returns a boolean.

#### Usage

```php
VolumeUnitEnum::MILLIGRAMS->isNotAny(['GRAMS', VolumeUnitEnum::TONNE]);                    // true
VolumeUnitEnum::MILLIGRAMS->isNotAny([VolumeUnitEnum::GRAMS, VolumeUnitEnum::MILLIGRAMS]); // false
```

### rule

The backed enums may be validated using Laravel's standard Enum validation rule - `new Illuminate\Validation\Rules\Enum(VolumeUnitEnum::class)`.  
This method a shortcut for the validation rule.

#### Usage

```
public function rules(): array
{
    return [
        'volume_unit' => [VolumeUnitEnum::rule()],
    ];
}
```

## Other Classes

### AsFullEnumCollection

This cast is similar to the Laravel built in `AsEnumCollection` cast but unlike the built-in will maintain the full `toArray` structure
when converting to json.

E.g. the Laravel built in `AsEnumCollection` cast will return the following json:

```json
[
    "MILLIGRAMS",
    "GRAMS"
]
```

This cast will return

```json
[
    {
        "name": "MILLIGRAMS",
        "value": "MILLIGRAMS",
        "label": "mg",
        "meta": {
            "background_color": "bg-green-100",
            "text_color": "text-green-800"
        }
    },
    {
        "name": "GRAMS",
        "value": "GRAMS",
        "label": "g",
        "meta": {
            "background_color": "bg-red-100",
            "text_color": "text-red-800"
        }
    }
]
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

We welcome all contributors to the project.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
