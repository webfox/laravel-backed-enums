<?php

namespace Webfox\LaravelBackedEnums;

use Illuminate\Container\Container;

/**
 * @implements \Webfox\LaravelBackedEnums\BackedEnum;
 */
trait IsBackedEnum
{
    public static function options(): array
    {
        return array_map(fn($enum) => $enum->toArray(), self::cases());
    }

    public static function values(): array
    {
        return array_map(fn($enum) => $enum->name, self::cases());
    }

    public static function getLabel(string $value): string
    {
        $lang_key = sprintf(
            '%s.%s.%s',
            'enums',
            static::class,
            $value
        );

        return app('translator')->has($lang_key) ? __($lang_key) : $value;
    }

    public function withMeta(): array
    {
        return [];
    }

    public function toArray(): array
    {
        return [
            'value' => $this->name,
            'label' => self::getLabel($this->name),
            'meta'  => $this->withMeta(),
        ];
    }

    public function toJson($options = 0): array
    {
        return $this->toArray();
    }
}
