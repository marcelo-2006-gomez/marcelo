<?php

$host = "localhost";
$bd = "MUEBLERIA";
$usuario = "root";
$contrasenia = "";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd;charset=utf8", $usuario, $contrasenia);

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "Error de conexión: " . $ex->getMessage();
    exit;
}
?>







