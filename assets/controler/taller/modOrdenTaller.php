<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$OrdenDetalle  = $_POST['forObs'];
$IdOrden       = $_POST['formMun'];


echo nl2br($OrdenDetalle);
// Consulta segura para evitar inyecciones SQL.

$sql = "UPDATE tab_orden 
SET detalle_servicio = '".$OrdenDetalle."'
WHERE id_cliente = ".$IdOrden.";";

if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/taller.php?alert=0'");
}

// close connection

mysqli_close($con);
?>