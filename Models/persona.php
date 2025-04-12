<?php

set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '/../');
require_once __DIR__ . '/../Database/conexion.php';

class Persona
{
    private PDO $conn;

    private int $id;
    private string $primer_nombre;
    private string $segundo_nombre;
    private string $primer_apellido;
    private string $segundo_apellido;
    private string $fecha_nacimiento;
    private string $id_tipo_documento;
    private string $n_documento;
    private string $id_g_sanguineo;
    private string $id_f_sanguineo;
    private string $id_genero;
    
    public function __construct($primer_nombre = '', $segundo_nombre = '', $primer_apellido = '', $segundo_apellido = '', $fecha_nacimiento = '',
    $id_tipo_documento = '', $n_documento = '', $id_g_sanguineo = '', $id_f_sanguineo = '', $id_genero = '')
    {
        $this->primer_nombre        = $primer_nombre;
        $this->segundo_nombre       = $segundo_nombre;
        $this->primer_apellido      = $primer_apellido;
        $this->segundo_apellido     = $segundo_apellido;
        $this->fecha_nacimiento     = $fecha_nacimiento;
        $this->id_tipo_documento    = $id_tipo_documento;
        $this->n_documento          = $n_documento;
        $this->id_f_sanguineo       = $id_f_sanguineo;
        $this->id_g_sanguineo       = $id_g_sanguineo;
        $this->id_genero            = $id_genero;

        $this->conn = (new Database())->getConnection();   // Conexión a la base de datos
    }   

    public function mostrarPersonas(){      // Lógica para mostrar todas las personas registradas
        $sql = "SELECT personas.* 
        FROM aprendices 
        JOIN personas ON aprendices.id_persona = personas.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result; 
    }

    public function crearPersona($datos){         // Lógica para insertar persona
        $sql = "INSERT INTO personas (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nacimiento, id_tipo_documento, n_documento, id_f_sanguineo, id_g_sanguineo, id_genero) 
        VALUES (:primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :fecha_nacimiento, :id_tipo_documento, :n_documento, :id_f_sanguineo, :id_g_sanguineo, :id_genero)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':primer_nombre', $datos['primer_nombre']);
        $stmt->bindParam(':segundo_nombre', $datos['segundo_nombre']);
        $stmt->bindParam(':primer_apellido', $datos['primer_apellido']);
        $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido']);
        $stmt->bindParam(':fecha_nacimiento', $datos['fecha_nacimiento']);
        $stmt->bindParam(':id_tipo_documento', $datos['id_tipo_documento']);
        $stmt->bindParam(':n_documento', $datos['n_documento']);
        $stmt->bindParam(':id_f_sanguineo', $datos['id_f_sanguineo']);
        $stmt->bindParam(':id_g_sanguineo', $datos['id_g_sanguineo']);
        $stmt->bindParam(':id_genero', $datos['id_genero']);

        try {
            $stmt->execute();
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function actualizarPersona(array $datos){   
        
        // Actualizar las propiedades del objeto
        $this->id               = $datos['id'];
        $this->primer_nombre    = $datos['primer_nombre'];
        $this->segundo_nombre   = $datos['segundo_nombre'];
        $this->primer_apellido  = $datos['primer_apellido'];
        $this->segundo_apellido = $datos['segundo_apellido'];
        $this->fecha_nacimiento = $datos['fecha_nacimiento'];
        $this->id_tipo_documento = $datos['id_tipo_documento'];
        $this->n_documento = $datos['n_documento'];
        $this->id_f_sanguineo = $datos['id_f_sanguineo'];
        $this->id_g_sanguineo = $datos['id_g_sanguineo'];
        $this->id_genero = $datos['id_genero'];

        // lógica para actualizar persona
        $sql = "UPDATE personas SET     
                    primer_nombre       = :primer_nombre, 
                    segundo_nombre      = :segundo_nombre, 
                    primer_apellido     = :primer_apellido, 
                    segundo_apellido    = :segundo_apellido, 
                    fecha_nacimiento    = :fecha_nacimiento,
                    id_tipo_documento   = :id_tipo_documento,
                    n_documento         = :n_documento,
                    id_f_sanguineo      = :id_f_sanguineo,
                    id_g_sanguineo      = :id_g_sanguineo,
                    id_genero           = :id_genero
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':primer_nombre', $this->primer_nombre);
        $stmt->bindParam(':segundo_nombre', $this->segundo_nombre);
        $stmt->bindParam(':primer_apellido', $this->primer_apellido);
        $stmt->bindParam(':segundo_apellido', $this->segundo_apellido);
        $stmt->bindParam(':fecha_nacimiento', $this->fecha_nacimiento);
        $stmt->bindParam(':id_tipo_documento', $this->id_tipo_documento);
        $stmt->bindParam(':n_documento', $this->n_documento);
        $stmt->bindParam(':id_f_sanguineo', $this->id_f_sanguineo);
        $stmt->bindParam(':id_g_sanguineo', $this->id_g_sanguineo);
        $stmt->bindParam(':id_genero', $this->id_genero);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function eliminarPersona($id){       // Lógica para eliminar persona
        $sql = "DELETE FROM personas WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPrimerNombre(): string
    {
        return $this->primer_nombre;
    }

    public function getSegundoNombre(): string
    {
        return $this->segundo_nombre;
    }

    public function getPrimerApellido(): string
    {
        return $this->primer_apellido;
    }

    public function getSegundoApellido(): string
    {
        return $this->segundo_apellido;
    }

    public function getFechaNacimiento(): string
    {
        return $this->fecha_nacimiento;
    }

    public function getIdTipoDocumento(): int
    {
        return $this->id_tipo_documento;
    }

    public function getNDocumento(): string
    {
        return $this->n_documento;
    }

    public function getIdFSanguineo(): int
    {
        return $this->id_f_sanguineo;
    }

    public function getIdGSanguineo(): int
    {
        return $this->id_g_sanguineo;
    }

    public function getIdGenero(): int
    {
        return $this->id_genero;
    }

    public function getEdad(): int      // Función para generar la edad según la fecha de nacimiento
    {
        $fechaNacimiento = new DateTime($this->fecha_nacimiento);
        $fechaActual = new DateTime();

        return $fechaActual->diff($fechaNacimiento)->y;
    }
    
}