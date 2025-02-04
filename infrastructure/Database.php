<?php

namespace Infrastructure;

use PDO;
use PDOException;

class Database
{
    private static ?\Infrastructure\Database $instance = null;
    private ?\PDO $pdo = null;

    private function __construct()
    {
        try {
            $config = require __DIR__ . '/Shared/config.php';
            $dsn = $config['database']['dsn'];
            $username = $config['database']['username'];
            $password = $config['database']['password'];

            $this->pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance(): \Infrastructure\Database
    {
        if (!self::$instance instanceof \Infrastructure\Database) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getPDO(): ?\PDO
    {
        return $this->pdo;
    }
}
