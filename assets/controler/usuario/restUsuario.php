<?php
include("../conexion.php");

$usuarioID = $_POST['formUseId'];
$contra =$_POST['formPasId'];

$sql = "UPDATE tab_users
            SET   pass_user  = SHA1('$contra')
            WHERE code_user   = ".$usuarioID.";";


        if (mysqli_query($con, $sql)) {
            header("HTTP/1.0 404 Not Found");
            header("Location: http://" . $base_url . "/CentroServicio/usuario?alert=2'");
        }


?>