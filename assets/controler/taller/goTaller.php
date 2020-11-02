<?php 
    session_start();
   include("../conexion.php");
   $id = $_POST['formIdOrden'];

$sql = "UPDATE tab_orden
SET   status_orden  = 'EN TALLER', 
      tec_taller  = '".$_SESSION['name_user']."'
WHERE id_orden = ".$id.";"; 

if (mysqli_query($con, $sql)) {

   $sql2 = "UPDATE tab_users
    SET   taller  = ".$id."
    WHERE code_user = ".$_SESSION['code_user'].";"; 

    if (mysqli_query($con, $sql2)) {
        header("HTTP/1.0 404 Not Found");
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/taller");
    }
    
}

// close connection

mysqli_close($con);

?>