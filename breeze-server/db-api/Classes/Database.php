<?php

namespace API\Database\Classes;

use API\Database\Utils\DbInfo;

class Database
{

    protected static $instance;

    private function __construct()
    {
        try {
            self::$instance =
                new \PDO(
                    'mysql:host=' . DbInfo::getHost() . ';dbname=' . DbInfo::getDbName() . ';charset=' . DbInfo::CHARSET,
                    DbInfo::getUsername(),
                    DbInfo::getPassword(),
                    array(\PDO::ATTR_PERSISTENT => true, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
                );
        } catch (\Exception $e) {
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            new Database();
        }

        return self::$instance;
    }
}
