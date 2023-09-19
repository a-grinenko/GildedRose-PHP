<?php

declare(strict_types=1);

namespace GildedRose\Config;

class Config
{
    protected static array $data = [];

    public static function get(string $key)
    {
        return static::$data[$key] ?? null;
    }
}
