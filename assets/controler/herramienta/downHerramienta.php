<?php
include("../conexion.php");

$HerramientaId         = $_POST['formHerId'];

$sql = "DELETE FROM tab_herramienta WHERE Id_herramienta   = ".$HerramientaId.";";

        if (mysqli_query($con, $sql)) {
            header("HTTP/1.0 404 Not Found");
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/herramienta?alert=2'");
        }

?>