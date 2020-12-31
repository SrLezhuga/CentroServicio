<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$sucursalId         = $_POST['formSucId'];
$sucursalNombre     = strtoupper($_POST['formSucNom']);
// Consulta segura para evitar inyecciones SQL.

$sql = "UPDATE tab_sucursal
SET   nom_sucursal  = '".$sucursalNombre."'
WHERE id_sucursal   = ".$sucursalId.";";

if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $base_url . "/CentroServicio/sucursales?alert=1'");
}

// close connection

mysqli_close($con);
?>