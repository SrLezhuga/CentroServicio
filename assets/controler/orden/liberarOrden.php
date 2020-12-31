<?php
session_start();
include("../conexion.php");
$id = $_POST['formOrdId'];

$queryOrden = "SELECT *  FROM tab_orden WHERE id_orden =" . $id;
$rsOrden = mysqli_query($con, $queryOrden) or die("Error de consulta");
$Orden = mysqli_fetch_array($rsOrden);
$tecnico = $Orden['tec_taller'];
$idOrden = $Orden['id_orden'];

$queryUser = "SELECT *  FROM tab_users WHERE name_user = '" . $tecnico . "'";
$rsUser = mysqli_query($con, $queryUser) or die("Error de consulta");
$User = mysqli_fetch_array($rsUser);

$code_user = $User['code_user'];

$sql = "UPDATE tab_orden
  SET   status_orden  = 'EN ESPERA',
        tec_taller    =  'Sin Asignar'
  WHERE id_orden      = " . $id . ";";

if (mysqli_query($con, $sql)) {

    if ($idOrden == $id) {
        $sql1 = "UPDATE tab_users
        SET   taller    =  0 
        WHERE code_user  = " . $code_user . ";";

        if (mysqli_query($con, $sql1)) {
            header("HTTP/1.0 404 Not Found");
            header("Location: http://" . $base_url . "/CentroServicio/listaPendiente?alert=0'");
        }

    }

    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $base_url . "/CentroServicio/listaPendiente?alert=0'");
}

?>