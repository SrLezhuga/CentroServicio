<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$OrdenId      = $_POST['formOrdId'];
$ServicioId   = $_POST['fromSerId'];

// Consulta segura para evitar inyecciones SQL.

$listSer = "SELECT * FROM tab_servicio WHERE id_servicio = $ServicioId"; 
    $rsSer = mysqli_query($con, $listSer) or die ("Error de consulta");      
    while ($itemSer = mysqli_fetch_array($rsSer)) { 
       $Codigo      =  $itemSer['cod_servicio'];
       $Descipcion  =  $itemSer['desc_servicio'];
       $Costo       =  $itemSer['costo_servicio'];
        
    }

$listUp = "INSERT INTO tab_ordenservicio VALUES (NULL, $OrdenId , '$Codigo', '$Descipcion', $Costo)";     
    if (mysqli_query($con, $listUp)) {
        header("HTTP/1.0 404 Not Found");
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/taller?alert=1'");
}

// close connection

mysqli_close($con);
?>