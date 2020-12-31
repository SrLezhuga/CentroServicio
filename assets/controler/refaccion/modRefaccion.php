<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$refaccionId            = $_POST['formRefId'];
$refaccionCodigo        = $_POST['forRefCod'];
$refaccionDescripcion   = $_POST['forRefDes'];
$refaccionMarca         = $_POST['forRefMar'];
$refaccionCantidad      = $_POST['forRefCan'];
$refaccionUnidad        = $_POST['forRefUni'];
$refaccionCosto         = $_POST['forRefCos'];

// Consulta segura para evitar inyecciones SQL.

$sql = "UPDATE tab_refaccion
SET   cod_refaccion     = '".$refaccionCodigo."', 
      desc_refaccion    = '".$refaccionDescripcion."',
      costo_refaccion   = '".$refaccionCosto."',
      marca_refaccion   = '".$refaccionMarca."',
      unidad_refaccion  = '".$refaccionUnidad."',
      cant_refaccion    = '".$refaccionCantidad."'
WHERE id_refaccion      = ".$refaccionId.";";

if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $base_url . "/CentroServicio/listaRefaccion?alert=1'");
}

// close connection

mysqli_close($con);
?>