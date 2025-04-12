<?php

class Database{
    private string $server = "localhost"; 
    private string $database = "crud_aprendices";
    private string $user = "root";
    private string $password = "";
    private PDO $conexion;
    
    public function getConnection(): PDO
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->server;dbname=$this->database", $this->user, $this->password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conexion;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}



