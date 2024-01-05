<?php

namespace API\Database\Utils;

use Jawira\CaseConverter\Convert;

abstract class Functions
{
    static function getBasePath()
    {
        $path = str_replace(array('\\', 'C:'), array('/', ''), realpath(dirname(__FILE__)));
        $path = explode('breeze-server', $path)[0];

        return $path;
    }

    static function deleteRecursively($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $object) && !is_link($dir . "/" . $object))
                        self::deleteRecursively($dir . DIRECTORY_SEPARATOR . $object);
                    else
                        unlink($dir . DIRECTORY_SEPARATOR . $object);
                }
            }
            rmdir($dir);
        }
    }

    static function extractControllers()
    {
        $fullpath = self::getBasePath() . 'breeze-server/db-api/Controllers';
        $files = $controllers = [];

        if (file_exists($fullpath)) $files = array_diff(scandir($fullpath), array('.', '..'));

        foreach ($files as $key => $file) {
            array_push($controllers, explode('.', $file)[0]);
        }

        return $controllers;
    }

    static function getPrefix()
    {
        $path = __DIR__ . "/../../config.ini";

        $config = file_exists($path) ? parse_ini_file($path) : [];

        if (isset($config['prefix'])) {

            if (self::endsWith($config['prefix'], '_')) return $config['prefix'];

            else return $config['prefix'] . '_';
        }

        return '';
    }

    static function resolveTableName($suffix)
    {
        if (self::startsWith($suffix, self::getPrefix())) return $suffix;

        return self::getPrefix() . $suffix;
    }

    static function getTableNameFromModel($obj)
    {
        $modelName = (new \ReflectionClass($obj))->getShortName();

        $trimmed = str_replace('Model', '', $modelName);

        $converted = new Convert($trimmed);

        return self::resolveTableName($converted->toSnake());
    }

    static function isAssoc(array $arr)
    {
        if (array() === $arr) return false;

        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    static function startsWith($string, $startString)
    {
        $len = strlen($startString);

        return (substr($string, 0, $len) === $startString);
    }

    static function endsWith($string, $endString)
    {
        $len = strlen($endString);

        if ($len == 0) return true;

        return (substr($string, -$len) === $endString);
    }
}
