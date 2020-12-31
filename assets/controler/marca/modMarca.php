<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$marcaId         = $_POST['formMarId'];
$marcaNombre     = strtoupper($_POST['formMarNom']);
// Consulta segura para evitar inyecciones SQL.

$sql = "UPDATE tab_marca
SET   marca_herramienta  = '".$marcaNombre."'
WHERE id_marca           = ".$marcaId.";";

if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $base_url . "/CentroServicio/marca?alert=1'");
}

// close connection

mysqli_close($con);
?>