<?php
class Dbcon{
    public $user;
    public $source;
    public $password;
    public $database;
    public $conn;

    function __construct($source = "localhost", $user = "root", $password = "", $database = "Cedcab")
    {
        $this->source = $source;
        $this->user = $user;
        $this->database = $database;
        $this->password = $password;

        $this->conn = new mysqli($this->source, $this->user, $this->password,  $this->database );

        if($this->conn->connect_error){
            die("Connection failed" .$this->conn->connect_error);
        }
    }
}