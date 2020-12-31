<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$refaccionCodigo       = strtoupper($_POST['forRefCod']);
$refaccionDescripcion  = strtoupper($_POST['forRefDes']);
$refaccionMarca        = strtoupper($_POST['forRefMar']);
$refaccionCosto        = $_POST['forRefCos'];

// Consulta segura para evitar inyecciones SQL.

$sql = "INSERT INTO tab_refaccion VALUES ('','$refaccionCodigo','$refaccionDescripcion','$refaccionMarca',$refaccionCosto)";
if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $base_url . "/CentroServicio/refaccion?alert=0'");
}

// close connection

mysqli_close($con);
?>