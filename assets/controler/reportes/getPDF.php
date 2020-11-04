<?php
session_start();
include("../conexion.php");
$id = $_GET['id'];

$queryPdf = "SELECT id_cliente, code_user, fech_salida, tec_taller  FROM tab_orden WHERE id_orden =".$id;
$rsPdf = mysqli_query($con, $queryPdf) or die("Error de consulta");
$Pdf = mysqli_fetch_array($rsPdf);

$queryCliente = "SELECT nom_cliente FROM tab_cliente WHERE id_cliente =".$Pdf['id_cliente'];
$rsCliente = mysqli_query($con, $queryCliente) or die("Error de consulta");
$Cliente = mysqli_fetch_array($rsCliente);

$queryMostrador = "SELECT name_user FROM tab_users WHERE code_user =".$Pdf['code_user'];
$rsMostrador = mysqli_query($con, $queryMostrador) or die("Error de consulta");
$Mostrador = mysqli_fetch_array($rsMostrador);

$recibe=$Cliente['nom_cliente'];
$mostrador=$Mostrador['name_user'];
$fecha= $Pdf['fech_salida'];

$folio = $id;
if (strlen($folio) == 1) {
    $folio = "0000" . $folio;
} else if (strlen($folio) == 2) {
    $folio = "000" . $folio;
} else if (strlen($folio) == 3) {
    $folio = "00" . $folio;
} else if (strlen($folio) == 4) {
    $folio = "0" . $folio;
}


echo "
    <h3 class='text-right' style='color: crimson;'><b>Folio: ".$folio."</b></h3>
        <div class='row'>
        <input type='hidden' name='reporte' value='".$id."' required>
            <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                <label>Cliente:</label>
                    <div class='input-group '>
                        <div class='input-group-prepend'>
                            <span class='input-group-text'>
                                <i class='fas fa-user-alt'></i>
                            </span>
                        </div>
                        <input type='text' class='form-control' placeholder='Nombre cliente' name='recibe' value='".$recibe."' required>
                    </div>
            </div>

                <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                    <label>Encargado:</label>
                    <div class='input-group '>
                        <div class='input-group-prepend'>
                            <span class='input-group-text'>
                                <i class='fas fa-store'></i>
                            </span>
                        </div>
                        <input type='text' class='form-control' name='mostrador' value='".$mostrador."' required readonly='yes' style='background-color: white;'>
                    </div>
                </div>

                <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                    <label>Fecha:</label>
                    <div class='input-group '>
                        <div class='input-group-prepend'>
                            <span class='input-group-text'>
                                <i class='fas fa-calendar-alt'></i>
                            </span>
                        </div>
                        <input type='date' class='form-control' name='fecha' value='".$fecha."' required readonly='yes' style='background-color: white;'>
                    </div>
                </div>
        </div>

                            

";

?>