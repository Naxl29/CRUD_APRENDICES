<?php

class Database{
    private string $host = "localhost"; 
    private string $database = "crud_aprendices";
    private string $user = "root";
    private string $password = "";
    
    public function conexion(){
        try{
            $PDO = new PDO("mysql:host=".$this->host.";database=".$this->database,$this->user,$this->password);
            return $PDO;
        } catch(PDOException $e){
            return $e->getMessage();
        }
    }
}

$obj = new Database();
print_r($obj->conexion());



//     public function getConnection(): PDO
//     {
//         try {
//             $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
//             $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             return $this->conexion;
//         } catch (PDOException $e) {
//             die("Error de conexión: " . $e->getMessage());
//         }
//     }
// }



