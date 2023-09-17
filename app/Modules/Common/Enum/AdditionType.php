<?php

namespace App\Modules\Common\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static AdditionType FIXED()
 * @method static AdditionType PERCENTAGE()
 */

class AdditionType extends Enum
{
    const FIXED = 'fixed';
    const PERCENTAGE = 'percentage';
}
