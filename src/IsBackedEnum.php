<?php

namespace Webfox\LaravelBackedEnums;


/**
 * @implements \Webfox\LaravelBackedEnums\BackedEnum<string,string>
 * @mixin \BackedEnum<string,string>
 */
trait IsBackedEnum
{

    protected static function ensureImplementsInterface(): void
    {
        throw_unless(class_implements(static::class, BackedEnum::class), new \Exception(sprintf('Enum %s must implement BackedEnum', static::class)));
    }

    public static function options(): array
    {
        static::ensureImplementsInterface();
        return array_map(fn($enum) => $enum->toArray(), self::cases());
    }

    public static function names(): array
    {
        static::ensureImplementsInterface();
        return array_map(fn($enum) => $enum->name, self::cases());
    }

    public static function values(): array
    {
        static::ensureImplementsInterface();
        return array_map(fn($enum) => $enum->value, self::cases());
    }

    public static function map(): array
    {
        static::ensureImplementsInterface();
        $array = [];

        foreach (self::cases() as $enum) {
            $array[$enum->name] = $enum->label();
        }

        return $array;
    }

    public static function labels(): array
    {
        static::ensureImplementsInterface();
        return array_map(fn($enum) => self::getLabel($enum->name), self::cases());
    }

    public static function labelFor(self $value): string
    {
        static::ensureImplementsInterface();
        $lang_key = sprintf(
            '%s.%s.%s',
            'enums',
            static::class,
            $value->value
        );

        return app('translator')->has($lang_key) ? __($lang_key) : $value->value;
    }

    public function label(): string
    {
        return static::labelFor($this);
    }

    public function withMeta(): array
    {
        return [];
    }

    public function toArray(): array
    {
        static::ensureImplementsInterface();
        return [
            'name'  => $this->name,
            'value' => $this->value,
            'label' => $this->label(),
            'meta'  => $this->withMeta(),
        ];
    }

    public function toHtml(): string
    {
        static::ensureImplementsInterface();
        return $this->label();
    }

    public function toJson($options = 0): array
    {
        static::ensureImplementsInterface();
        return $this->toArray();
    }

    public function is(string|self $value): bool
    {
        static::ensureImplementsInterface();
        return $this->isAny([$value]);
    }

    public function isA(string|self $value): bool
    {
        static::ensureImplementsInterface();
        return $this->is($value);
    }

    public function isAn(string|self $value): bool
    {
        static::ensureImplementsInterface();
        return $this->is($value);
    }

    public function isAny(array $values): bool
    {
        static::ensureImplementsInterface();

        if (empty($values)) {
            return false;
        }

        $values = array_map(fn($value) => $value instanceof static ? $value : static::from($value), $values);
        return in_array($this, $values);
    }

    public function isNot(string|self $value): bool
    {
        static::ensureImplementsInterface();
        return !$this->isAny([$value]);
    }

    public function isNotA(string|self $value): bool
    {
        static::ensureImplementsInterface();
        return $this->isNot($value);
    }

    public function isNotAn(string|self $value): bool
    {
        static::ensureImplementsInterface();
        return $this->isNot($value);
    }

    public function isNotAny(array $values): bool
    {
        static::ensureImplementsInterface();
        return !$this->isAny($values);
    }
}
