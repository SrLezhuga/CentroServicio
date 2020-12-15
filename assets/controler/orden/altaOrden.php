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
$ordenSerie              = $_POST['forOrdSerie'];
$ordenAdicional          = $_POST['forOrdAdd'];
$ordenDetalles           = $_POST['forOrdDet'];
$ordenComplemento        = $_POST['forOrdComp'];
$ordenUser               = $_SESSION['code_user'];

// Consulta segura para evitar inyecciones SQL.

 echo $sql = "INSERT INTO tab_orden VALUES 
('', '$clienteDatos', '$ordenUser', '$ordenFecha', '', 'EN ESPERA', DEFAULT, '$ordenHerramienta', '$ordenMarca', '$ordenModelo', '$ordenAdicional', '$ordenServicio', '$ordenDetalles',  'Sin Asignar', 'Sin Asignar', 'Sin Asignar', '$ordenSerie', '$ordenComplemento')";

if (mysqli_query($con, $sql)) {

    
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/orden?alert=0'");

}

// close connection

mysqli_close($con);
?>