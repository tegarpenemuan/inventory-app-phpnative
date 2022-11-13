<?php

class Database
{
    private $hostname;
    private $user;
    private $pass;
    private $database;
    public $conn;

    public function __construct($host, $user, $pass, $database)
    {
        $this->hostname = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;

        $this->conn = new mysqli(
            $this->hostname,
            $this->user,
            $this->pass,
            $this->database,
        );

        if (!$this->conn) {
            return false;
        } else {
            return true;
        }
    }
}