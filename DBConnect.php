<?php

class DBConnect
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=127.0.0.1;dbname=gestion-de-contacts;charset=utf8', 'root', '');
    }

    public function getPDO()
    {
        return $this->db;
    }
}
