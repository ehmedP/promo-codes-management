<?php
namespace Models;

use Config\Database;

class BaseModel {
    protected $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
}