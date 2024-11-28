<?php

class Database {
    private $server_name = HOST_DB;
    private $db_name = NAME_DB;
    private $user_name = USER_DB;
    private $password = PASS_DB;
    private $con;

    public function __construct() {
        $this->con = $this->db_connection($this->server_name, $this->user_name, $this->password, $this->db_name);
        if ($this->con === false) {
            // echo "<script>console.log('Connection failed: " . mysqli_connect_error() . "');</script>";
        } else {
            // echo "<script>console.log('Connected successfully');</script>";
        }
    }

    private function db_connection($svr_nm, $usr_nm, $pass, $db_nm) {
        $conn = new mysqli($svr_nm, $usr_nm, $pass, $db_nm);
        if ($conn->connect_error) {
            echo "<script>console.log('Connection failed: " . $conn->connect_error . "');</script>";
            return false;
        }
        return $conn;
    }

    public function query($sql) {
        $result = $this->con->query($sql);
        if (!$result) {
            echo "<script>console.log('Query failed: " . $this->con->error . "');</script>";
        }
        return $result;
    }

    public function escape_string($string) {
        return $this->con->real_escape_string($string);
    }

    public function db_close() {
        if ($this->con !== false) {
            $this->con->close();
        }
    }

    public function prepare($sql) {
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            echo "<script>console.log('Prepare failed: " . $this->con->error . "');</script>";
        }
        return $stmt;
    }
}


// content

