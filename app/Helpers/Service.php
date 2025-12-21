<?php

namespace App\Helpers;

class Service
{

    static function generateOtp(int $length): string
    {
        $min = 10 ** ($length - 1);
        $max = (10 ** $length) - 1;

        return str_pad(
            (string) random_int($min, $max),
            $length,
            '0',
            STR_PAD_LEFT
        );
    }
}