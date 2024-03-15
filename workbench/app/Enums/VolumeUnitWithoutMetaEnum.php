<?php

namespace Workbench\App\Enums;

use Webfox\LaravelBackedEnums\BackedEnum;
use Webfox\LaravelBackedEnums\IsBackedEnum;

enum VolumeUnitWithoutMetaEnum: string implements BackedEnum
{
    use IsBackedEnum;

    case MILLIGRAMS = "milligrams";
    case GRAMS      = "grams";
    case KILOGRAMS  = "kilograms";
    case TONNE      = "tonne";

}