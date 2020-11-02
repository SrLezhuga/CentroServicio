<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$refaccionCodigo       = $_POST['forRefCod'];
$refaccionDescripcion  = $_POST['forRefDes'];
$refaccionMarca        = $_POST['forRefMar'];
$refaccionCantidad     = $_POST['forRefCan'];
$refaccionCosto        = $_POST['forRefCos'];

// Consulta segura para evitar inyecciones SQL.

$sql = "INSERT INTO tab_refaccion VALUES ('','$refaccionCodigo','$refaccionDescripcion','$refaccionMarca',$refaccionCantidad,$refaccionCosto)";
if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/taller?alert=3'");
}

// close connection

mysqli_close($con);
?>