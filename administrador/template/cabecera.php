<?php

session_start();


if (!isset($_SESSION['usuario'])){
header("location:../index.php");
}else{
    if($_SESSION['usuario']=="ok"){
        $nombreUsuario=$_SESSION["nombreUsuario"];
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet"href="/muebleria/css/bootstrap.min.css"/>
    <title>inicio </title>
</head>
<body>
<?php
$url="http://".$_SERVER['HTTP_HOST']."/MUEBLERIA";
    ?>

<br></br>
<nav class="navbar navbar-expand navbar-light bg-light"><!--b4navminimal-a para agregar barrinicio-->
    <div class="nav navbar-nav">
        <a class="nav-item nav-link active" href="<?PHP echo $url;?>/administrador/inicio.php">inico </a>
        <a class="nav-item nav-link" href="<?PHP echo $url;?>/administrador/seccion/producto.php">muebles</a>
        <a class="nav-item nav-link" href="<?PHP echo $url;?>/administrador/seccion/cerrar.php">cerrar</a>
        <a class="nav-item nav-link" href="<?PHP echo $url;?>">ver sitio web</a>
    </div>
    
</nav>  

<div class="container">
        <div class="row">
