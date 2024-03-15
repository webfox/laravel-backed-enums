<?php

namespace Webfox\LaravelBackedEnums;

use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Validation\Rules\Enum as EnumValidationRule;
use function get_class;
use function json_encode;
use function json_last_error;
use function json_last_error_msg;
use const JSON_ERROR_NONE;

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
            $array[$enum->value] = $enum->label();
        }

        return $array;
    }

    public static function labels(): array
    {
        static::ensureImplementsInterface();
        return array_map(fn($enum) => self::labelFor($enum), self::cases());
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

    public static function rule(): EnumValidationRule
    {
        static::ensureImplementsInterface();
        return new EnumValidationRule(static::class);
    }

    public function label(): string
    {
        static::ensureImplementsInterface();
        return static::labelFor($this);
    }

    public function withMeta(): array
    {
        static::ensureImplementsInterface();
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

    public function toJson($options = 0): string
    {
        static::ensureImplementsInterface();
        $json = json_encode($this->toArray(), $options);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new JsonEncodingException('Error encoding enum ['.get_class($this).'] with value ['.$this->value.'] to JSON: '. json_last_error_msg());
        }

        return $json;
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
