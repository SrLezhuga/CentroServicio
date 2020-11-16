<?php
include("../conexion.php");

$refaccionID   = $_POST['formRefId'];

$sql = "DELETE FROM tab_refaccion WHERE id_refaccion = " . $refaccionID;
if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/refaccion?alert=2'");
}

// close connection

mysqli_close($con);
?>