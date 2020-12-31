<?php 
include("../conexion.php");
$countTotal = "SELECT COUNT(*) FROM tab_orden";
$rsTotal = mysqli_query($con, $countTotal) or die("Error de consulta");
$itemTotal = mysqli_fetch_array($rsTotal);
echo $Total = $itemTotal[0];
?>