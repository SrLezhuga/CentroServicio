<?php
   session_start();
   include("../conexion.php");
   $Refaccion = $_POST['formRefId'];
   $Orden = $_POST['formOrdId'];


   $listRef = "SELECT * FROM tab_refaccion WHERE id_refaccion = $Orden"; 
    $rsRef = mysqli_query($con, $listRef) or die ("Error de consulta");      
    $itemRef = mysqli_fetch_array($rsRef);
       $CantOld     =  $itemRef[cant_refaccion];
       $NewCant     =  $CantOld+1;
    
       $listDown = "DELETE FROM tab_ordenrefaccion WHERE cod_refaccion = '$Refaccion' AND id_orden = $Orden LIMIT 1";
   if (mysqli_query($con, $listDown)) {
     $listUp = "UPDATE tab_refaccion
        SET cant_refaccion  = cant_refaccion + 1
      WHERE cod_refaccion    = '$Refaccion'";
      if(mysqli_query($con, $listUp)){

        header("HTTP/1.0 404 Not Found");
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/taller.php?alert=1'");
      }
   }

   mysqli_close($con);
?>