<?php


namespace App\database;

session_start();

use PDO;

class Config extends PDO
{

    // Settings
    private $hostname = "mysql:host=localhost;dbname=youtube_colores";
    private $username = "root";
    private $password = "";

    public function __construct()
    {
        // Establecer conexion
        try {

            // $pdo = new PDO($this->getHostname(), username: $this->getUsername(), password: $this->getPassword());
            parent::__construct($this->getHostname(), username: $this->getUsername(), password: $this->getPassword());
        } catch (\PDOException $error) {
            //throw $th;
            die();
            echo $error;
        }
    }


    public function getHostname()
    {
        return $this->hostname;
    }


    public function getUsername()
    {
        return $this->username;
    }


    public function getPassword()
    {
        return $this->password;
    }
}