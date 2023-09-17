<?php

namespace App\Modules\Common\Support;

use App\Modules\Common\Enum\AdditionType;

class Addition
{
    public static function getValue($type, $value, $cost)
    {
        if ($type === AdditionType::FIXED) {
            return $value;
        } elseif ($type === AdditionType::PERCENTAGE) {
            return (($value * $cost) / 100);
        }
    }
}
