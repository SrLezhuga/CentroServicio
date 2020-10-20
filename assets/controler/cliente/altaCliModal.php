<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$clienteNombre     = $_POST['formCliNom'];
$clienteDomicilio  = $_POST['formCliDom'];
$clienteTelefono   = $_POST['formCliTel'];
$clienteRfc        = $_POST['formCliRfc'];
$clienteCP         = $_POST['formCliCP'];
$clienteMunicipio  = $_POST['formCliMun'];
$clienteMail       = $_POST['formCliMail'];

// Consulta segura para evitar inyecciones SQL.

$sql = "INSERT INTO tab_cliente VALUES ('','$clienteNombre','$clienteDomicilio','$clienteMunicipio',$clienteCP,'$clienteTelefono','$clienteRfc', '$clienteMail')";
if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/orden.php?alert=1'");
}

// close connection

mysqli_close($con);
?>