<?php

namespace API\Database\Utils;

abstract class DbInfo
{
    const CHARSET = 'utf8mb4';

    static function getHost()
    {
        return self::getConfig()['host'] ?? '';
    }

    static function getDbName()
    {
        return self::getConfig()['dbname'] ?? '';
    }

    static function getUsername()
    {
        return self::getConfig()['username'] ?? '';
    }

    static function getPassword()
    {
        return self::getConfig()['password'] ?? '';
    }

    private static function getConfig()
    {
        $path = __DIR__ . "/../../config.ini";

        if (file_exists($path)) return parse_ini_file($path);

        return [];
    }
}
