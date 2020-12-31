<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$OrdenId      = $_POST['formOrdId'];
$refaccionId  = $_POST['fromRefId'];

// Consulta segura para evitar inyecciones SQL.

$listRef = "SELECT * FROM tab_refaccion WHERE id_refaccion = $refaccionId"; 
    $rsRef = mysqli_query($con, $listRef) or die ("Error de consulta");      
    while ($itemRef = mysqli_fetch_array($rsRef)) { 
        $Codigo      =  $itemRef['cod_refaccion'];
        $Descipcion  =  $itemRef['desc_refaccion'];
        $Marca       =  $itemRef['marca_refaccion'];
        $Costo       =  $itemRef['costo_refaccion'];
        
    }

$listUp = "INSERT INTO tab_ordenrefaccion VALUES ($OrdenId , '$Codigo', '$Descipcion' , '$Marca', $Costo)";     
    if (mysqli_query($con, $listUp)) {

    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $base_url . "/CentroServicio/taller?alert=1'");

    }

// close connection

mysqli_close($con);
?>