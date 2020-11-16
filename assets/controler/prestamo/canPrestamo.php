<?php
session_start();
include("../conexion.php");

$id_prestamo    = $_POST['formPreFin'];
$id_herramienta    = $_POST['formPreHer'];
$fechaEntrada   = date('Y-m-d');

$sql = "UPDATE tab_prestamo
SET   status_prestamo        = 'CANCELADA', 
      fech_entrada_prestamo  = '".$fechaEntrada."'
WHERE id_prestamo            = ".$id_prestamo.";";

if (mysqli_query($con, $sql)) {

    $sql = "UPDATE tab_herramienta
    SET   status_herramienta     = 'DISPONIBLE'
    WHERE Id_herramienta         = ".$id_herramienta.";";

    if (mysqli_query($con, $sql)) {
        header("HTTP/1.0 404 Not Found");
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/prestamo?alert=2'");
    }

}

mysqli_close($con);
?>