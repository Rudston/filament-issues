<?php

namespace App\Utilities;


class StringUtilities
{
    /**
     * @param $length int
     * @return string
     */
    public static function generateRandomString($length = 10): string
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
}
