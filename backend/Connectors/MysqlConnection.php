<?php

namespace Connectors;

use Interfaces\DatabaseConnection;

class MysqlConnection implements DatabaseConnection
{

    private static $instance = null;
    private $mysql_conn;

    private function __construct() {
        $this->mysql_conn = new \PDO("mysql:host=" . $_ENV["DB_HOST"] . ";dbname=" . $_ENV["DB_NAME"] . "", 
                                $_ENV["DB_USERNAME"], 
                                $_ENV["DB_PASSWORD"]);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection() {
        return $this->mysql_conn;
    }

    public function closeConnection() {
        $this->mysql_conn = null;
    }

}