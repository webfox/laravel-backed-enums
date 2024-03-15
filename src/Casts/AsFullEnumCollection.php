<?php
declare(strict_types=1);

namespace Webfox\LaravelBackedEnums\Casts;

use BackedEnum;
use LogicException;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use function is_int;
use function collect;
use function is_array;
use function constant;
use function is_string;
use function is_subclass_of;

/**
 * @template T of \UnitEnum|\BackedEnum
 */
class AsFullEnumCollection implements CastsAttributes
{
    /**
     * @param class-string<T> $enumClass
     */
    public function __construct(protected string $enumClass)
    {
    }

    /**
     * @param class-string<T> $class
     */
    public static function of(string $class): string
    {
        return static::class.':'.$class;
    }

    /**
     * @return \Illuminate\Support\Collection<T>|null
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?Collection
    {
        if (empty($attributes[$key])) {
            return new Collection();
        }

        $data = Json::decode($attributes[$key]);

        if (!is_array($data)) {
            throw new LogicException('Invalid data for enum collection cast: ' . $attributes[$key]);
        }


        return (new Collection($data))->map(function($value) {
            return is_subclass_of($this->enumClass, BackedEnum::class)
                ? $this->enumClass::from($value)
                : constant($this->enumClass . '::' . $value);
        });
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        $valueArray = Collection::wrap($value)
            ->map(fn($enum) => $this->getStorableEnumValue($enum))
            ->jsonSerialize();

        return [$key => Json::encode($valueArray)];
    }

    protected function getStorableEnumValue($enum)
    {
        if (is_string($enum) || is_int($enum)) {
            return $enum;
        }

        return $enum instanceof BackedEnum ? $enum->value : $enum->name;
    }
}