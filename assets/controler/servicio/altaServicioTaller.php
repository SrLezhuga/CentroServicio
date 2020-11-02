<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$servicioCodigo       = $_POST['forSerCod'];
$servicioDescripcion  = $_POST['forSerDes'];
$servicioCosto        = $_POST['forSerCos'];

// Consulta segura para evitar inyecciones SQL.

$sql = "INSERT INTO tab_servicio VALUES ('','$servicioCodigo','$servicioDescripcion',$servicioCosto)";
if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/taller?alert=0'");
}

// close connection

mysqli_close($con);
?>