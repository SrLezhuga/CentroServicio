<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$servicioId            = $_POST['formSerId'];
$servicioCodigo        = $_POST['forSerCod'];
$servicioDescripcion   = $_POST['forSerDes'];
$servicioCosto         = $_POST['forSerCos'];

// Consulta segura para evitar inyecciones SQL.

$sql = "UPDATE tab_servicio
SET   cod_servicio  = '".$servicioCodigo."', 
      desc_servicio  = '".$servicioDescripcion."',
      costo_servicio   = '".$servicioCosto."'
WHERE id_servicio   = ".$servicioId.";";

if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $base_url . "/CentroServicio/servicio?alert=1'");
}

// close connection

mysqli_close($con);
?>