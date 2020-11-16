<?php
include("../conexion.php");
$año = $_POST['año'];

$canceladas  = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS o FROM `tab_orden` WHERE status_orden = 'CANCELADA' AND YEAR(fech_entrada)=$año"));
$terminadas  = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS o FROM `tab_orden` WHERE YEAR(fech_entrada)=$año AND( status_orden = 'ENTREGADA' OR status_orden = 'REPARADA')"));
$pendientes  = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS o FROM `tab_orden` WHERE YEAR(fech_entrada)=$año AND( status_orden = 'PxP' OR status_orden = 'EN ESPERA' OR status_orden = 'PxA' OR status_orden = 'APROVADA PxP' OR status_orden = 'EN TALLER')"));

$data = [ 0 => $canceladas['o'],
          1 => $terminadas['o'],
          2 => $pendientes['o']
        ];

   echo json_encode($data);
   

?>