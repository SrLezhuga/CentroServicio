<?php
include("../conexion.php");

$usuarioID = $_POST['formUseId'];
$contra ="Mfa@2020";

$sql = "UPDATE tab_users
            SET   pass_user  = SHA1('$contra')
            WHERE code_user   = ".$usuarioID.";";


        if (mysqli_query($con, $sql)) {
            header("HTTP/1.0 404 Not Found");
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/usuario?alert=2'");
        }


?>