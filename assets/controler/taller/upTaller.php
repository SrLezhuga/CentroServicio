<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$Status     = $_POST['formStatus'];
$Id         = $_POST['formId'];

// Consulta segura para evitar inyecciones SQL.

$sql = "UPDATE tab_orden
SET   status_orden  = '".$Status."'
WHERE id_orden = ".$Id.";"; 

if (mysqli_query($con, $sql)) {
    unset($_SESSION['id_Orden']);
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/taller.php?alert=1'");
}

// close connection

mysqli_close($con);
?>