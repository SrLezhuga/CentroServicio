<?php 
   session_start();
   include("../conexion.php");
   $_SESSION['id_Orden'] = $_POST['formIdOrden'];

$sql = "UPDATE tab_orden
SET   status_orden  = 'EN TALLER', 
      tec_taller  = '".$_SESSION['name_user']."'
WHERE id_orden = ".$_SESSION['id_Orden'].";"; 

if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/taller.php");
}

// close connection

mysqli_close($con);

?>