<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$usuarioNombre     = $_POST['formUseNom'];
$usuarioApellido   = $_POST['formUseApe'];
$usuarioUsuario    = strtoupper($_POST['formUseUsu']);
$usuarioSucursal   = $_POST['formUseSuc'];
$usuarioContra     = $_POST['formUseCon'];
$usuarioPriv       = $_POST['fromUsePriv'];

$usuarioNombres = $usuarioNombre ." ". $usuarioApellido;

// Consulta segura para evitar inyecciones SQL.

echo $sql = "INSERT INTO tab_users VALUES (NULL,'$usuarioNombres','$usuarioUsuario',SHA1('$usuarioContra'), $usuarioPriv, '1', 0 , '$usuarioSucursal')";
if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $base_url . "/CentroServicio/usuario.php?alert=0'");
}

// close connection
mysqli_close($con);
?>