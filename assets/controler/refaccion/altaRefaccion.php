<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$refaccionCodigo       = strtoupper($_POST['forRefCod']);
$refaccionDescripcion  = strtoupper($_POST['forRefDes']);
$refaccionMarca        = strtoupper($_POST['forRefMar']);
$refaccionCantidad     = $_POST['forRefCan'];
$refaccionUnidad        = strtoupper($_POST['forRefUni']);
$refaccionCosto        = $_POST['forRefCos'];

// Consulta segura para evitar inyecciones SQL.

$sql = "INSERT INTO tab_refaccion VALUES ('','$refaccionCodigo','$refaccionDescripcion','$refaccionMarca',$refaccionCantidad,'$refaccionUnidad',$refaccionCosto)";
if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/refaccion?alert=0'");
}

// close connection

mysqli_close($con);
?>