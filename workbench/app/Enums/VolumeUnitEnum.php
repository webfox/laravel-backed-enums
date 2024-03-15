<?php

namespace Workbench\App\Enums;

use Webfox\LaravelBackedEnums\BackedEnum;
use Webfox\LaravelBackedEnums\IsBackedEnum;

enum VolumeUnitEnum: string implements BackedEnum
{
    use IsBackedEnum;

    case MILLIGRAMS = "milligrams";
    case GRAMS      = "grams";
    case KILOGRAMS  = "kilograms";
    case TONNE      = "tonne";

    public function withMeta(): array
    {
        return match ($this) {
            self::MILLIGRAMS             => [
                'background_color' => 'bg-green-100',
                'text_color'       => 'text-green-800',
            ],
            self::GRAMS                  => [
                'background_color' => 'bg-red-100',
                'text_color'       => 'text-red-800',
            ],
            self::KILOGRAMS, self::TONNE => [
                'background_color' => 'bg-gray-100',
                'text_color'       => 'text-gray-800',
            ],
            default                      => [
                'background_color' => 'bg-blue-100',
                'text_color'       => 'text-blue-800',
            ],
        };
    }
}