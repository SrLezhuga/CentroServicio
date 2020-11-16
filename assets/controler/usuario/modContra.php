<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$passOld    = $_POST['formUseOld'];
$passN1     = $_POST['formUseNew1'];
$passN2     = $_POST['formUseNew2'];
$user       = $_SESSION['code_user'];

$encry= sha1($passOld);

$queryPass = "SELECT pass_user FROM tab_users where code_user =" . $user ; 
$rsPass = mysqli_query($con, $queryPass) or die ("Error de consulta"); 
$Pass = mysqli_fetch_array($rsPass);

$Pass['pass_user'];

if ($Pass['pass_user']==$encry) {
    if ($passN1==$passN2) {
            $sql = "UPDATE tab_users
            SET   pass_user  = SHA1($passN1)
            WHERE code_user   = ".$user.";";
        if (mysqli_query($con, $sql)) {
            header("HTTP/1.0 404 Not Found");
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/ajustes?alert=2'");
        }
    }else {
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/ajustes?alert=1'");
    }
}else {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/ajustes?alert=0'");
}

// close connection

mysqli_close($con);
