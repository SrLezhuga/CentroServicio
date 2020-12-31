<?php
   session_start();
   include("../conexion.php");
    $Refaccion = $_POST['formRefId'];
    $Orden = $_POST['formOrdId'];
   
     $listDown = "DELETE FROM tab_ordenrefaccion WHERE cod_refaccion = '$Refaccion' AND id_orden = $Orden LIMIT 1";
       if (mysqli_query($con, $listDown)) {

        header("HTTP/1.0 404 Not Found");
        header("Location: http://" . $base_url . "/CentroServicio/taller?alert=1'");
      }

   mysqli_close($con);
?>