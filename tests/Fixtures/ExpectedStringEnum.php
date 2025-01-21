<?php

namespace Workbench\App\Enums;

use Webfox\LaravelBackedEnums\BackedEnum;
use Webfox\LaravelBackedEnums\IsBackedEnum;

enum StringEnum: string implements BackedEnum
{
    use IsBackedEnum;

    /**
     * Add your Enums below using.
     * e.g. case Standard = 'standard';
     */

}
