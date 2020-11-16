<?php
session_start();
include("../conexion.php");

$id_herramienta        = $_POST['forPreHer'];
$datos_cliente         = $_POST['forPreCli'];
$status_herrramienta   = "EN PRESTAMO";
$fecha                 = date('Y-m-d');

$item = explode("|" , $datos_cliente);
$id_cliente = $item[0];
$cliente = $item[1];

$queryDatosHerramienta = "SELECT * FROM tab_herramienta WHERE Id_herramienta =" . $id_herramienta; 
$rsDatosHerramienta = mysqli_query($con, $queryDatosHerramienta) or die ("Error de consulta 2"); 
$DatosHerramienta = mysqli_fetch_array($rsDatosHerramienta);
    $cod_herramienta = $DatosHerramienta["cod_herramienta"];
    $desc_herramienta = $DatosHerramienta["desc_herramienta"];
    $marca_herramienta = $DatosHerramienta["marca_herramienta"];

$sql = "INSERT INTO tab_prestamo VALUES ('','$id_herramienta','$cod_herramienta','$desc_herramienta','$marca_herramienta', $id_cliente, '$cliente','$fecha','','$status_herrramienta');";
if (mysqli_query($con, $sql)) {

   $sql1 = "UPDATE tab_herramienta
        SET   status_herramienta  = '".$status_herrramienta."'
        WHERE Id_herramienta   = ".$id_herramienta.";";

    if (mysqli_query($con, $sql1)) {
        header("HTTP/1.0 404 Not Found");
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/prestamo?alert=0'");
    }
}

// close connection

mysqli_close($con);
?>