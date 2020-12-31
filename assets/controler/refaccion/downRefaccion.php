<?php
include("../conexion.php");

$refaccionID   = $_POST['formRefId'];

$sql = "DELETE FROM tab_refaccion WHERE id_refaccion = " . $refaccionID;
if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $base_url . "/CentroServicio/refaccion?alert=2'");
}

// close connection

mysqli_close($con);
?>