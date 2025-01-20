<?php

namespace App;

use Webfox\LaravelBackedEnums\BackedEnum;
use Webfox\LaravelBackedEnums\IsBackedEnum;

enum IntEnum: int implements BackedEnum
{
    use IsBackedEnum;

    /**
     * Add your Enums below using.
     * e.g. case Standard = 'standard';
     */

}
