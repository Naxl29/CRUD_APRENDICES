<?php
    class Persona {
        private $PDO;
        public function __construct()
        {
            require_once("c://laragon/www/CRUD_APRENDICES/Database/conexion.php");
            $con = new Database();
            $this->PDO = $con->conexion();
        }

        public function crearPersona($primer_nombre){
            $stmt = $this->PDO->prepare("INSERT INTO personas VALUES(null, :primer_nombre)");
            $stmt->bindParam(':primer_nombre', $primer_nombre); 
            return ($stmt->execute()) ? $this->PDO->lastInsertId() : false; 
        }

        public function show($id){
            $stmt = $this->PDO->prepare("SELECT * FROM personas WHERE id = :id limit 1");
            $stmt->bindParam(":id",$id);
            return ($stmt->execute()) ? $stmt->fetch() : false ;
        }

        public function index(){
            $stmt = $this->PDO->prepare("SELECT * FROM personas");
            return ($stmt->execute()) ? $stmt->fetchAll() : false;
        }

        public function update($id, $primer_nombre){
            $stmt = $this->PDO->prepare("UPDATE personas SET primer_nombre = :primer_nombre WHERE id = :id");
            $stmt->bindParam(":primer_nombre",$primer_nombre);
            $stmt->bindParam(":id",$id);
            return ($stmt->execute()) ? $id : false ;

        }
    }
?>