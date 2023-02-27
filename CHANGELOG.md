# Changelog

All notable changes to `laravel-backed-enums` will be documented in this file.

## Add support for direct value comparisons - 2023-02-27

Right now if you want to use `->isA` or `->isAny` or the other comparison methods you must pass in an enum instance, I.e.

```php
$user->role->isA(MyEnum::from('admin'));           // true
$user->role->isA('admin');                         // false

$user->role->isA(MyEnum::from('not-a-value'));     // exception
$user->role->isA('not-a-value');                   // false

$user->role->isAny([MyEnum::from('admin')]);       // true
$user->role->isAny(['admin']);                     // false

$user->role->isAny([MyEnum::from('not-a-value')]); // exception
$user->role->isAny(['not-a-value']);               // false

```
This release makes it so each pair of methods will act the same whether given a string value or an enum instance.

```php
$user->role->isA(MyEnum::from('admin'));           // true
$user->role->isA('admin');                         // true

$user->role->isA(MyEnum::from('not-a-value'));     // exception
$user->role->isA('not-a-value');                   // exception

$user->role->isAny([MyEnum::from('admin')]);       // true
$user->role->isAny(['admin']);                     // true

$user->role->isAny([MyEnum::from('not-a-value')]); // exception
$user->role->isAny(['not-a-value']);               // exception

```
This also applies for isAn, isNotA, isNotAn, isNotAny

## v1.2.1 - 2023-02-22

### What's Changed

- Add support for laravel 10

## v1.1.0 - 2022-10-04

### What's Changed

- Add support for rendering enums in blade by @hailwood in https://github.com/webfox/laravel-backed-enums/commit/c8724cafa35dbec93ddc23e8f20c9808ab8f4da3

**Full Changelog**: https://github.com/webfox/laravel-backed-enums/compare/v1.0.1...v1.1.0

## Added new fields to toArray, minor bug fixes - 2022-09-21

Added new fields to toArray, minor bug fixes

## v1.0.0 - 2022-09-19

Initial release
