<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Data access:
// Class for connecting to database

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "root";
    private $db = "multitier_appstore";

    protected $conn;

    // Connect to the database in the constructor so all member functions can use $this->conn
    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);

        if (!$this->conn) {
            die("Error connection to db!");
        }
    }

    // Retrieves all rows from the specified 
    // table in the database and returns the result.
    protected function getAllRowsFromTable($Users)
    {
        // Variables inside the query are OK when the variables are not user input.
        // Never use variables directly in queries when the variables value is user input.
        $query = "SELECT * FROM {$Users}";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->get_result();

        return $result;
    }
}

?>