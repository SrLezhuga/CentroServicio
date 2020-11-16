<?php
session_start();
include("../conexion.php");
ECHO $id = $_GET['id'];

$item=explode("|",$id);

$id_cliente  = $item[1];
$id_prestamo = $item[0];


$queryCli = "SELECT * FROM tab_cliente WHERE id_cliente = " . $id_cliente;
$resultSetCli = mysqli_query($con, $queryCli) or die("Error de consulta");
$itemCli = mysqli_fetch_array($resultSetCli);

$queryPre = "SELECT * FROM tab_prestamo WHERE Id_prestamo = " . $id_prestamo;
$resultSetPre = mysqli_query($con, $queryPre) or die("Error de consulta");
$itemPre = mysqli_fetch_array($resultSetPre);

if ($itemPre["fech_entrada_prestamo"]=="0000-00-00") {
    $fechaEntrega="SIN DEFINIR";
}else {
    $fechaEntrega=$itemPre["fech_entrada_prestamo"];
}

echo '
<fieldset class="border p-2">
    <legend  class="w-auto">Datos del Cliente:</legend>
   <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
         <label>Cliente:</label>
         <span class="input-group-text" style="background-color:white">
         <i class="fas fa-user-alt"></i>
         <a>&nbsp;&nbsp;' . $itemCli["nom_cliente"] .'</a>
         </span>
      </div>
      
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
         <label>Domicilio:</label>
         <span class="input-group-text" style="background-color:white">
         <i class="fas fa-home"></i>
         <a>&nbsp;&nbsp;' . $itemCli["dir_cliente"] .'</a>
         </span>
      </div>
   </div>
   <div class="row">
   
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <label>Municipio:</label>
      <span class="input-group-text" style="background-color:white">
         <i class="fas fa-map-marker-alt"></i>
      <a>&nbsp;&nbsp;' . $itemCli["mun_cliente"] . '</a>
      </span>
   </div>
   
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <label>Codigo Postal:</label>
      <span class="input-group-text" style="background-color:white">
         <i class="fas fa-hashtag"></i>
      <a>&nbsp;&nbsp;' . $itemCli["cp_cliente"] . '</a>
      </span>
   </div>
   
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
         <label>Teléfono:</label>
         <span class="input-group-text" style="background-color:white">
         <i class="fas fa-phone-alt"></i>
         <a>&nbsp;&nbsp;' . $itemCli["tel_cliente"] . '</a>
         </span>
      </div>
    </div>
   <div class="row">
   
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
         <label>Correo:</label>
         <span class="input-group-text" style="background-color:white">
         <i class="fas fa-at"></i>
         <a>&nbsp;&nbsp;' . $itemCli["mail_cliente"] . '</a>
         </span>
      </div>
      
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
         <label>RFC:</label>
         <span class="input-group-text" style="background-color:white">
         <i class="fas fa-address-card"></i>
         <a>&nbsp;&nbsp;' . $itemCli["rfc_cliente"] . '</a>
         </span>
      </div>
   </div>
   </fieldset>


<fieldset class="border p-2">
<legend class="w-auto">Datos del Prestamo:</legend>
<div class="row">

    <div class="col-6">
        <label>Código:</label>
        <span class="input-group-text" style="background-color:white">
                <i class="fas fa-barcode"></i>
                <a>&nbsp;&nbsp;' . $itemPre["cod_herramienta"] . '</a>
             </span>
    </div>

    <div class="col-6">
        <label>Marca:</label>
            <span class="input-group-text" style="background-color:white">
                <i class="fas fa-tag"></i>
                <a>&nbsp;&nbsp;' . $itemPre["marca_prestamo"] . '</a>
            </span>
    </div>

    <div class="col-12">
        <label>Descripción:</label>
            <span class="input-group-text" style="background-color:white">
                <i class="fas fa-tasks"></i>
                <a>&nbsp;&nbsp;' . $itemPre["desc_prestamo"] . '</a>
            </span>
    </div>

    <div class="col-4">
        <label>Fecha Salida:</label>
            <span class="input-group-text" style="background-color:white">
                <i class="fas fa-calendar-alt"></i>
                <a>&nbsp;&nbsp;' . $itemPre["fech_salida_prestamo"] . '</a>
            </span>
    </div>

    <div class="col-4">
        <label>Fecha Entrega:</label>
            <span class="input-group-text" style="background-color:white">
                <i class="fas fa-calendar-alt"></i>
                <a>&nbsp;&nbsp;' . $fechaEntrega . '</a>
            </span>
    </div>

    <div class="col-4">
        <label>Status:</label>
            <span class="input-group-text" style="background-color:white">
                <i class="fas fa-stethoscope"></i>
                <a>&nbsp;&nbsp;' . $itemPre["status_prestamo"] . '</a>
            </span>
    </div>

</div>

<br>

<!--/. form-->
</fieldset>

';

mysqli_close($con);
?>