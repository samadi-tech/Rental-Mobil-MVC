<?php

namespace SamTech\Config;

use PDOStatement;

class Database
{
    private static ?\PDO $pdo = null;

    public static function getConection(String $env = "test")
    {
        if (self::$pdo == null) {

            require_once __DIR__ . "/../../config/database.php";
            $config = getDatabase();
            self::$pdo = new \PDO(
                $config['database'][$env]['url'],
                $config['database'][$env]['username'],
                $config['database'][$env]['password'],
            );
        }
        return self::$pdo;
    }
}
