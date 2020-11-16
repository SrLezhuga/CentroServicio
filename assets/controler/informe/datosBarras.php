<?php
include("../conexion.php");
$año = $_POST['año'];

    $enero       = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS Mes FROM `tab_orden` WHERE  status_orden != 'CANCELADA' AND MONTH(fech_entrada)=1  AND YEAR(fech_entrada)=$año"));
    $febrero     = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS Mes FROM `tab_orden` WHERE  status_orden != 'CANCELADA' AND MONTH(fech_entrada)=2  AND YEAR(fech_entrada)=$año"));
    $marzo       = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS Mes FROM `tab_orden` WHERE  status_orden != 'CANCELADA' AND MONTH(fech_entrada)=3  AND YEAR(fech_entrada)=$año"));
    $abril       = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS Mes FROM `tab_orden` WHERE  status_orden != 'CANCELADA' AND MONTH(fech_entrada)=4  AND YEAR(fech_entrada)=$año"));
    $mayo        = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS Mes FROM `tab_orden` WHERE  status_orden != 'CANCELADA' AND MONTH(fech_entrada)=5  AND YEAR(fech_entrada)=$año"));
    $junio       = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS Mes FROM `tab_orden` WHERE  status_orden != 'CANCELADA' AND MONTH(fech_entrada)=6  AND YEAR(fech_entrada)=$año"));
    $julio       = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS Mes FROM `tab_orden` WHERE  status_orden != 'CANCELADA' AND MONTH(fech_entrada)=7  AND YEAR(fech_entrada)=$año"));
    $agosto      = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS Mes FROM `tab_orden` WHERE  status_orden != 'CANCELADA' AND MONTH(fech_entrada)=8  AND YEAR(fech_entrada)=$año"));
    $septiembre  = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS Mes FROM `tab_orden` WHERE  status_orden != 'CANCELADA' AND MONTH(fech_entrada)=9  AND YEAR(fech_entrada)=$año"));
    $octubre     = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS Mes FROM `tab_orden` WHERE  status_orden != 'CANCELADA' AND MONTH(fech_entrada)=10 AND YEAR(fech_entrada)=$año"));
    $noviembre   = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS Mes FROM `tab_orden` WHERE  status_orden != 'CANCELADA' AND MONTH(fech_entrada)=11 AND YEAR(fech_entrada)=$año"));
    $diciembre   = mysqli_fetch_array(mysqli_query($con, "SELECT count(id_orden) AS Mes FROM `tab_orden` WHERE  status_orden != 'CANCELADA' AND MONTH(fech_entrada)=12 AND YEAR(fech_entrada)=$año"));

    $data = [ 0 => $enero['Mes'],
              1 => $febrero['Mes'],
              2 => $marzo['Mes'],
              3 => $abril['Mes'],
              4 => $mayo['Mes'],
              5 => $junio['Mes'],
              6 => $julio['Mes'],
              7 => $agosto['Mes'],
              8 => $septiembre['Mes'],
              9 => $octubre['Mes'],
              10 => $noviembre['Mes'],
              11 => $diciembre['Mes']
            ];

   echo json_encode($data);
   
?>