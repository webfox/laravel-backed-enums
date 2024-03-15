# Changelog

All notable changes to `laravel-backed-enums` will be documented in this file.

## v2.3.1 - 2024-03-15

### What's Changed

* Add unit/feature tests by @hailwood in https://github.com/webfox/laravel-backed-enums/pull/25
* Fix `::labels()` method by @hailwood in https://github.com/webfox/laravel-backed-enums/pull/25
* Add `AsFullEnumCollection::of(MyEnum::class)` for casts by @hailwood in https://github.com/webfox/laravel-backed-enums/pull/25
* Fix Issue #22: Replace 'self' with 'static'  by @vikas020807 in https://github.com/webfox/laravel-backed-enums/pull/24

### New Contributors

* @vikas020807 made their first contribution in https://github.com/webfox/laravel-backed-enums/pull/24

**Full Changelog**: https://github.com/webfox/laravel-backed-enums/compare/v2.3.0...v2.3.1

## v2.3.0 - 2024-03-12

### What's Changed

* Bumping to version 11 of the Laravel framework (ahead of launch tomorrow) by @csoutham in https://github.com/webfox/laravel-backed-enums/pull/23
* Bump stefanzweifel/git-auto-commit-action from 4 to 5 by @dependabot in https://github.com/webfox/laravel-backed-enums/pull/19

### New Contributors

* @csoutham made their first contribution in https://github.com/webfox/laravel-backed-enums/pull/23

**Full Changelog**: https://github.com/webfox/laravel-backed-enums/compare/v2.2.0...v2.3.0

## v2.2.0 - 2023-10-07

### What's Changed

- Add EnumCollection support by @hailwood in https://github.com/webfox/laravel-backed-enums/pull/17
  Fix toJson method to actually return a json string instead of an array.
  Add new `AsFullEnumCollection` cast - See the readme for usage and a description of why this is useful.

**Full Changelog**: https://github.com/webfox/laravel-backed-enums/compare/v2.1.1...v2.2.0

## v2.1.1 - 2023-10-04

**Full Changelog**: https://github.com/webfox/laravel-backed-enums/compare/v2.1.0...v2.1.1

## v2.1.0 - 2023-10-05

- Add static `rule()` method as a shortcut for the laravel validation rule.

## v2.0.0 - 2023-08-28

### What's Changed

- Use value in `map()` method

## v1.2.3 - 2023-03-02

### What's Changed

- Add additional comparison methods

**Full Changelog**: https://github.com/webfox/laravel-backed-enums/compare/v1.1.0...v1.2.3

## v1.2.2 - 2023-02-28

### What's Changed

- Add support for direct value comparisons

**Full Changelog**: https://github.com/webfox/laravel-backed-enums/compare/v1.2.1...v1.2.2

## v1.2.1 - 2023-02-22

### What's Changed

- Add support for laravel 10

**Full Changelog**: https://github.com/webfox/laravel-backed-enums/compare/v1.1.0...v1.2.1

## v1.1.0 - 2022-10-04

### What's Changed

- Add support for rendering enums in blade templates

**Full Changelog**: https://github.com/webfox/laravel-backed-enums/compare/v1.0.1...v1.1.0

## Added new fields to toArray, minor bug fixes - 2022-09-21

Added new fields to toArray, minor bug fixes

## v1.0.0 - 2022-09-19

Initial release
