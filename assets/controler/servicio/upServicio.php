<?php
   session_start();
   include("../conexion.php");
   $servicio = $_POST['formSerId'];
   $Orden = $_POST['formOrdId'];


  
       $listDown = "DELETE FROM tab_ordenservicio WHERE cod_servicio = '$servicio' AND id_orden = $Orden LIMIT 1";
   if (mysqli_query($con, $listDown)) {
  
        header("HTTP/1.0 404 Not Found");
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/taller.php?alert=1'");
      }
  

   mysqli_close($con);
?>