<?php

namespace API\SSR\Utils;

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
        $paths = [
            "/../../",
            "/../../../",
            "/../../breeze-server/",
            "/../../../breeze-server/",
        ];

        $filename = "config.ini";
        $content = [];

        foreach ($paths as $path) {

            if (file_exists(__DIR__ . $path . $filename)) {

                $content = parse_ini_file(__DIR__ . $path . $filename);

                break;
            }
        }

        return $content;
    }
}
