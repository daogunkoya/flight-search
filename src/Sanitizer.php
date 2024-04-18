<?php

namespace App;

class Sanitizer
{
    public static function sanitizeAirportCode(string $code): string
    {
        return htmlspecialchars(trim($code), ENT_QUOTES, 'UTF-8');
    }
}
