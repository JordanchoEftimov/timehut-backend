<?php

namespace App\Helpers;

class NetToGross
{
    public static function netToGross($net): float
    {
        $grossWithoutContributions = ($net - 903.8) / 0.9;

        $gross = $grossWithoutContributions / 0.72;

        return round($gross);
    }
}
