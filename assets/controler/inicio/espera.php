<?php 
include("../conexion.php");
$countCompletas = "SELECT COUNT(*) FROM tab_orden WHERE status_orden = 'EN ESPERA'";
$rsCompletas = mysqli_query($con, $countCompletas) or die("Error de consulta");
$itemCompletas = mysqli_fetch_array($rsCompletas);
echo $completas=$itemCompletas[0];
?>