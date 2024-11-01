<?php
namespace Config;

use mysqli;

class Database {
    private $host;
    private $username;
    private $password;
    private $dbname;
    public $conn;

    public function __construct() {

        $this->host = EnvLoader::get('DB_HOST', 'localhost');
        $this->username = EnvLoader::get('DB_USERNAME', 'root');
        $this->password = EnvLoader::get('DB_PASSWORD', '');
        $this->dbname = EnvLoader::get('DB_NAME', '');

    }

    public function getConnection() {
        $this->conn = null;

        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        
        $this->conn->set_charset("utf8mb4");

        if ($this->conn->connect_error) {
            die(json_encode(["status" => false, "message" => "Connection Failed: " . $this->conn->connect_error]));
        }

        return $this->conn;
    }
}
