<?php
session_start();
include("../conexion.php");

function Datos(){
    $countPendientes = "SELECT  status_orden, count(status_orden) FROM `tab_orden` WHERE status_orden = 'PxP' OR status_orden = 'PxA' OR status_orden = 'APROVADA PxP' OR status_orden = 'EN TALLER' group by status_orden";
    $rsPendientes = mysqli_query($con, $countPendientes) or die("Error de consulta");
    $itemPendientes = mysqli_fetch_array($rsPendientes);
    $pendientes = $itemPendientes[0];
}
?>