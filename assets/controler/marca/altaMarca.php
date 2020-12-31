<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
echo $marcaNombre     = strtoupper($_POST['formMarNom']);

// Consulta segura para evitar inyecciones SQL.

echo $sql = "INSERT INTO tab_marca VALUES ('','$marcaNombre')";
if (mysqli_query($con, $sql)) {
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $base_url . "/CentroServicio/marca?alert=0'");
}

// close connection

mysqli_close($con);
?>