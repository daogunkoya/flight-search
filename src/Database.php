<?php

namespace App;

use PDO;
use PDOException;

class Database
{
    private array $config;

    public function __construct()
    {
        $this->config = require 'config.php';
    }

    public function getConnection(): PDO
    {
        try {
            $conn = new PDO("mysql:host={$this->config['host']};dbname={$this->config['dbname']}", $this->config['username'], $this->config['password']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
    }
}
