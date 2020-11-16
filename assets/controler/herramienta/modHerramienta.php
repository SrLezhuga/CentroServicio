<?php
session_start();
include("../conexion.php");

echo $id_herramienta        = $_POST['forHerId'];
echo $cod_herramienta       = $_POST['forHerCod'];
echo $desc_herramienta      = $_POST['forHerDes'];
echo $marca_herramienta     = $_POST['forHerMar'];

$sql = "UPDATE tab_herramienta
SET   cod_herramienta  = '".$cod_herramienta."', 
      desc_herramienta  = '".$desc_herramienta."',
      marca_herramienta  = '".$marca_herramienta."'
WHERE Id_herramienta   = ".$id_herramienta.";";

if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/herramienta?alert=1'");
}

mysqli_close($con);
?>