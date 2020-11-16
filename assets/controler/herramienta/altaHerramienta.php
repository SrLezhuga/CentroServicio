<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$cod_herramienta       = $_POST['forHerCod'];
$desc_herramienta      = $_POST['forHerDes'];
$marca_herramienta     = $_POST['forHerMar'];
$status_herrramienta   = "DISPONIBLE";

// Consulta segura para evitar inyecciones SQL.

$sql = "INSERT INTO tab_herramienta VALUES ('','$cod_herramienta','$desc_herramienta','$marca_herramienta','$status_herrramienta')";
if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/herramienta?alert=0'");
}

// close connection

mysqli_close($con);
?>