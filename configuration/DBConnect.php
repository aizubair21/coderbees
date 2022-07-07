<?php

class DBConnection
{
    private $host = 'localhost', $user = 'root', $password = '', $db = 'coderbees';
    public $mysqli;

    public function __construct()
    {
        $connect = new mysqli($this->host, $this->user, $this->password, $this->db);
        $this->mysqli = $connect;
    }


    //destruct
    public function __destruct()
    {
        $this->mysqli->close();
    }
}
