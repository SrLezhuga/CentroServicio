<?php
session_start();
include("../conexion.php");

// Obtengo los datos cargados en el formulario de login.
$Status     = $_POST['formStatus'];
$Id         = $_POST['formId'];

if ($Status == "REPARADA") {
    $Fecha = date('Y-m-d', strtotime("now"));

    // Consulta segura para evitar inyecciones SQL.

    $sql = "UPDATE tab_orden
            SET   status_orden  = '" . $Status . "',
                  fech_salida   =  '" . $Fecha . "'
            WHERE id_orden      = " . $Id . ";";

    if (mysqli_query($con, $sql)) {

        $sql2 = "UPDATE tab_users
                SET   taller    = 0
                WHERE code_user = " . $_SESSION['code_user'] . ";";

        if (mysqli_query($con, $sql2)) {
            header("HTTP/1.0 404 Not Found");
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/taller?alert=1'");
        }
    }

    // close connection
    mysqli_close($con);
} else {

    // Consulta segura para evitar inyecciones SQL.

    $sql = "UPDATE tab_orden
            SET   status_orden  = '" . $Status . "'
            WHERE id_orden      = " . $Id . ";";

    if (mysqli_query($con, $sql)) {

        $sql2 = "UPDATE tab_users
                SET   taller    = 0
                WHERE code_user = " . $_SESSION['code_user'] . ";";

        if (mysqli_query($con, $sql2)) {
            header("HTTP/1.0 404 Not Found");
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/taller?alert=1'");
        }
    }

    // close connection

    mysqli_close($con);
}
?>