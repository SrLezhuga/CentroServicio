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
        $CantOld     =  $itemRef[cant_refaccion];
        $Codigo      =  $itemRef[cod_refaccion];
        $Descipcion  =  $itemRef[desc_refaccion];
        $Marca       =  $itemRef[marca_refaccion];
        $Costo       =  $itemRef[costo_refaccion];
        
    }

$NewCant = $CantOld -1 ;

$listUp = "INSERT INTO tab_ordenrefaccion VALUES ($OrdenId , '$Codigo', '$Descipcion' , '$Marca', $Costo)";     
    if (mysqli_query($con, $listUp)) {

        $sql = "UPDATE tab_refaccion
                   SET cant_refaccion  = '".$NewCant."'
                 WHERE id_refaccion    = ".$refaccionId.";";

if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/taller.php?alert=1'");
}

    }

// close connection

mysqli_close($con);
?>