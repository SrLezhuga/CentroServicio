<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$clienteId         = $_POST['formCliId'];
$clienteNombre     = $_POST['formCliNom'];
$clienteDomicilio  = $_POST['formCliDom'];
$clienteTelefono   = $_POST['formCliTel'];
$clienteRfc        = $_POST['formCliRfc'];
$clienteCP         = $_POST['formCliCP'];
$clienteMunicipio  = $_POST['formCliMun'];
$clienteCorreo     = $_POST['formCliMail'];

// Consulta segura para evitar inyecciones SQL.

$sql = "UPDATE tab_cliente
SET   nom_cliente  = '".$clienteNombre."', 
      dir_cliente  = '".$clienteDomicilio."',
      mun_cliente  = '".$clienteMunicipio."',
      cp_cliente   = '".$clienteCP."',
      tel_cliente  = '".$clienteTelefono."',
      rfc_cliente  = '".$clienteRfc."',
      mail_cliente = '".$clienteCorreo."'
WHERE id_cliente   = ".$clienteId.";";

if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/listaCliente?alert=0'");
}

// close connection

mysqli_close($con);
?>