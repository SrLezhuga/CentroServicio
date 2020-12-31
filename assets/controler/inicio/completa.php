<?php 
include("../conexion.php");
$countPendientes = "SELECT COUNT(*) FROM tab_orden WHERE  status_orden = 'REPARADA' OR status_orden = 'CANCELADA' OR status_orden = 'ENTREGADA'";
$rsPendientes = mysqli_query($con, $countPendientes) or die("Error de consulta");
$itemPendientes = mysqli_fetch_array($rsPendientes);
echo $pendientes = $itemPendientes[0];
?>