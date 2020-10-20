<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$clienteDatos            = $_POST['fromOrdCli'];
$ordenServicio           = $_POST['fromOrdSer'];
$ordenFecha              = $_POST['forOrdFec'];
$ordenHerramienta        = $_POST['forOrdHer'];
$ordenMarca              = $_POST['fromOrdMar'];
$ordenModelo             = $_POST['forOrdMod'];
$ordenAdicional          = $_POST['forOrdAdd'];
$ordenCaracteristicas    = $_POST['forOrdCar'];
$ordenDetalles           = $_POST['forOrdDet'];
$ordenCosto              = $_POST['forOrdCos'];
$ordenUser               = $_SESSION['name_user'];

// Consulta segura para evitar inyecciones SQL.

echo $sql = "INSERT INTO tab_orden VALUES 
('', '$clienteDatos', '$ordenUser', '$ordenFecha', '', 'EN ESPERA', DEFAULT, '$ordenCaracteristicas', '$ordenMarca', '$ordenModelo', '$ordenAdicional','$ordenHerramienta', '$ordenServicio', '$ordenDetalles', $ordenCosto, 'Sin Asignar')";

if (mysqli_query($con, $sql)) {

    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/orden.php?alert=0'");

}

// close connection

mysqli_close($con);
?>