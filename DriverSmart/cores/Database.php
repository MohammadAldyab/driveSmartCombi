<?php

class Database
{
    //Database connection elements
    private $servername = 'localhost';
    private $dbname = 'drivesmartt';
    private $email = 'root';
    private $password = 'root';
    //Connect to the database
    protected function connect()
    {
        try {
            $conn = new PDO('mysql:host=' . $this->servername . ';dbname=' . $this->dbname . '', $this->email, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
