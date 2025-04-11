<?php

$server = "localhost";
$database = "crud_aprendices";
$user = "root";
$password = "";

$conexion = mysqli_connect($server, $user, $password, $database);

try {
    if (!$conexion) {
        throw new Exception("Error de conexión: " . mysqli_connect_error());
    } else {
        // echo "Conexión exitosa a la base de datos.";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
