<?php
include("../conexion.php");

$usuarioID         = $_POST['formUseId'];
$usuarioNombre     = $_POST['formUseNom'];
$usuarioSucursal   = strtoupper($_POST['formUseSuc']);
$usuarioUsuario    = strtoupper($_POST['formUseUsu']);
$usuarioPriv       = $_POST['fromUsePriv'];

$sql = "UPDATE tab_users
            SET   name_user  = '". $usuarioNombre ."',
                  nick_user  = '". $usuarioUsuario ."',
                  priv_user  = ". $usuarioPriv .",
                  sucursal_user  = '". $usuarioSucursal ."'
            WHERE code_user   = ".$usuarioID.";";


        if (mysqli_query($con, $sql)) {
            header("HTTP/1.0 404 Not Found");
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/usuario?alert=1'");
        }

?>