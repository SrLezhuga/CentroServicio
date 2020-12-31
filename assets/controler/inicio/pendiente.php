<?php 
include("../conexion.php");
$countPendientes = "SELECT COUNT(*) FROM tab_orden WHERE  status_orden = 'PxP' OR status_orden = 'PxA' OR status_orden = 'AUTORIZADA PxP' OR status_orden = 'EN TALLER'";
$rsPendientes = mysqli_query($con, $countPendientes) or die("Error de consulta");
$itemPendientes = mysqli_fetch_array($rsPendientes);
echo $pendientes = $itemPendientes[0];
?>