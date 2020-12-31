<?php
session_start();
include("../conexion.php");
$id = $_POST['id'];

$query = "SELECT * FROM tab_orden WHERE id_orden = " . $id;
$resultSet = mysqli_query($con, $query) or die("Error de consulta");
$item = mysqli_fetch_array($resultSet);

if ($item==null) {
    echo "
<img class='img-fluid mx-auto d-block' src='http://192.168.0.98/CentroServicio/assets/img/Logo/logo.webp' 
      style='position: absolute; left: 4em; z-index: 0; opacity: 0.15; filter: grayscale(1); width: 400px; height: 400px;' onContextMenu='return false;' draggable='false'> 
<h3 style='color: crimson; text-align: right;'><b>Folio: </b>N/A</h3>

<fieldset class='border p-2'>
    <legend  class='w-auto'>Datos del Folio:</legend>
        <div class='row'>
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <label>Cliente:</label>
                <span class='input-group-text' style='background-color:white'>
                    <i class='fas fa-user-alt'></i>
                    <a>&nbsp;&nbsp;---</a>
                </span>
            </div>
        </div>
        <div class='row'>
            <div class='col-12'>
               <div class='row'>
                  <!--Campo servicio -->
                  <div class='col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12'>
                     <label>Tipo de servicio:</label>
                     <span class='input-group-text' style='background-color:white'>
                     <i class='fas fa-cogs'></i>
                     <a>&nbsp;&nbsp;---</a>
                     </span>
                  </div>
                  <!--Campo Fecha -->
                  <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                     <label>Fecha:</label>
                     <span class='input-group-text' style='background-color:white'>
                     <i class='fas fa-calendar-alt'></i>
                     <a>&nbsp;&nbsp;---</a>
                     </span>
                  </div>
                  <!--Campo Herramienta -->
                  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                     <label>Herramienta:</label>
                     <span class='input-group-text' style='background-color:white'>
                     <i class='fas fa-tools'></i>
                     <a>&nbsp;&nbsp;---</a>
                     </span>
                  </div>
               </div>
            </div>
            <div class='col-12'>
               <div class='row'>
                  <!--Campo Técnico -->
                    <div class='col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12'>
                        <label>Técnico:</label>
                        <span class='input-group-text' style='background-color:white'>
                            <i class='fas fa-toolbox'></i>
                            <a>&nbsp;&nbsp;---</a>
                        </span>
                    </div>
                  <!--Campo Status -->
                  <div class='col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12'>
                     <label>Status:</label>
                     <span class='input-group-text' style='background-color:white'>
                        <i class='fas fa-stethoscope'></i>
                     <a>&nbsp;&nbsp;---</a>
                     </span>
                  </div>
                  <!--/. form producto -->
               </div>
               <div>
               </fieldset>
               </div>
            </div>
         </div>
</fieldset>
";
}else {
    $folio = $item['id_orden'];
if (strlen($folio) == 1) {
    $folio = "0000" . $folio;
} elseif (strlen($folio) == 2) {
    $folio = "000" . $folio;
} elseif (strlen($folio) == 3) {
    $folio = "00" . $folio;
} elseif (strlen($folio) == 4) {
    $folio = "0" . $folio;
}


$queryCliente = "SELECT * FROM tab_cliente WHERE id_cliente = $item[id_cliente]";
($rsCliente = mysqli_query($con, $queryCliente)) or die("Error de consulta");
$Cliente = mysqli_fetch_array($rsCliente);

echo "
<img class='img-fluid mx-auto d-block' src='http://192.168.0.98/CentroServicio/assets/img/Logo/logo.webp' 
      style='position: absolute; left: 4em; z-index: 0; opacity: 0.15; filter: grayscale(1); width: 400px; height: 400px;' onContextMenu='return false;' draggable='false'> 
<h3 style='color: crimson; text-align: right;'><b>Folio: </b>" .
$folio .
"</h3>

<fieldset class='border p-2'>
    <legend  class='w-auto'>Datos del Folio:</legend>
        <div class='row'>
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <label>Cliente:</label>
                <span class='input-group-text' style='background-color:white'>
                    <i class='fas fa-user-alt'></i>
                    <a>&nbsp;&nbsp;" . $Cliente['nom_cliente'] ."</a>
                </span>
            </div>
        </div>
        <div class='row'>
            <div class='col-12'>
               <div class='row'>
                  <!--Campo servicio -->
                  <div class='col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12'>
                     <label>Tipo de servicio:</label>
                     <span class='input-group-text' style='background-color:white'>
                     <i class='fas fa-cogs'></i>
                     <a>&nbsp;&nbsp;" . $item['tipo_servicio'] . "</a>
                     </span>
                  </div>
                  <!--Campo Fecha -->
                  <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                     <label>Fecha:</label>
                     <span class='input-group-text' style='background-color:white'>
                     <i class='fas fa-calendar-alt'></i>
                     <a>&nbsp;&nbsp;" . $item['fech_entrada'] . "</a>
                     </span>
                  </div>
                  <!--Campo Herramienta -->
                  <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                     <label>Herramienta:</label>
                     <span class='input-group-text' style='background-color:white'>
                     <i class='fas fa-tools'></i>
                     <a>&nbsp;&nbsp;" .  $item['desc_herramienta'] . "</a>
                     </span>
                  </div>
               </div>
            </div>
            <div class='col-12'>
               <div class='row'>
                  <!--Campo Técnico -->
                    <div class='col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12'>
                        <label>Técnico:</label>
                        <span class='input-group-text' style='background-color:white'>
                            <i class='fas fa-toolbox'></i>
                            <a>&nbsp;&nbsp;" . $item['tec_taller'] . "</a>
                        </span>
                    </div>
                  <!--Campo Status -->
                  <div class='col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12'>
                     <label>Status:</label>
                     <span class='input-group-text' style='background-color:white'>
                        <i class='fas fa-stethoscope'></i>
                     <a>&nbsp;&nbsp;" . $item['status_orden'] . "</a>
                     </span>
                  </div>
                  <!--/. form producto -->
               </div>
               <div>
               </fieldset>
               </div>
            </div>
         </div>
</fieldset>
";

}

?>