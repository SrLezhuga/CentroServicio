<?php
include("../conexion.php");

$usuarioID         = $_POST['formUseId'];

$sql = "UPDATE tab_users
            SET   nick_user  = NULL,
                  pass_user  = NULL
            WHERE code_user   = ".$usuarioID.";";


        if (mysqli_query($con, $sql)) {
            header("HTTP/1.0 404 Not Found");
            header("Location: http://" . $base_url . "/CentroServicio/usuario?alert=3'");
        }

?>