<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$usuarioNombre     = $_POST['formUseNom'];
$usuarioUsuario    = strtoupper($_POST['formUseUsu']);
$usuarioContra     = $_POST['formUseCon'];
$usuarioPriv       = $_POST['fromUsePriv'];

// Consulta segura para evitar inyecciones SQL.

$sql = "INSERT INTO tab_users VALUES (NULL,'$usuarioNombre','$usuarioUsuario',SHA1('$usuarioContra'), $usuarioPriv, '1', 0)";
if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/usuario.php?alert=0'");
}

// close connection
mysqli_close($con);
?>