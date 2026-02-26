<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Util;

class ConvertAmount
{
    public static function convert(float $amount): int
    {
        return (int)round($amount * 100);
    }
}
