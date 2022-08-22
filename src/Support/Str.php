<?php

namespace PestPlayground\Runtime\Support;

class Str
{
    public static function beforeLast(string $character, string $subject): string
    {
        $parts = explode($character, $subject);
        array_pop($parts);

        return implode($character, $parts);
    }
}
