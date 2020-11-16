<?php
session_start();
include "../conexion.php";
$id = $_GET['id'];

$queryOrden = "SELECT *  FROM tab_orden WHERE id_orden =" . $id;
($rsOrden = mysqli_query($con, $queryOrden)) or die("Error de consulta");
while ($Orden = mysqli_fetch_array($rsOrden)) {
    $folio = $Orden['id_orden'];
    if (strlen($folio) == 1) {
        $folio = "0000" . $folio;
    } elseif (strlen($folio) == 2) {
        $folio = "000" . $folio;
    } elseif (strlen($folio) == 3) {
        $folio = "00" . $folio;
    } elseif (strlen($folio) == 4) {
        $folio = "0" . $folio;
    }

    $queryCliente = "SELECT * FROM tab_cliente WHERE id_cliente = $Orden[id_cliente]";
    ($rsCliente = mysqli_query($con, $queryCliente)) or die("Error de consulta");
    while ($Cliente = mysqli_fetch_array($rsCliente)) {
        echo "
   <img class='img-fluid mx-auto d-block' src='../CentroServicio/assets/img/Logo/logo.webp' 
      style='position: absolute; z-index: 0; opacity: 0.15; filter: grayscale(1);' onContextMenu='return false;' draggable='false'> 
   <h3 style='color: crimson; text-align: right;'><b>Folio: </b>" .
            $folio .
            "</h3>
   <fieldset class='border p-2'>
    <legend  class='w-auto'>Datos del Cliente:</legend>
   <div class='row'>
      <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
         <label>Cliente:</label>
         <span class='input-group-text' style='background-color:white'>
         <i class='fas fa-user-alt'></i>
         <a>&nbsp;&nbsp;" .
            $Cliente['nom_cliente'] .
            "</a>
         </span>
      </div>
      <!--Campo Domicilio -->
      <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
         <label>Domicilio:</label>
         <span class='input-group-text' style='background-color:white'>
         <i class='fas fa-home'></i>
         <a>&nbsp;&nbsp;" .
            $Cliente['dir_cliente'] .
            "</a>
         </span>
      </div>
   </div>
   <div class='row'>
    <!--Campo municipio -->
    <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
      <label>Municipio:</label>
      <span class='input-group-text' style='background-color:white'>
         <i class='fas fa-map-marker-alt'></i>
      <a>&nbsp;&nbsp;" .
            $Cliente['mun_cliente'] .
            "</a>
      </span>
   </div>
    <!--Campo Codigo Postal -->
    <div class='col-lg-3 col-md-3 col-sm-12 col-xs-12'>
      <label>Codigo Postal:</label>
      <span class='input-group-text' style='background-color:white'>
         <i class='fas fa-hashtag'></i>
      <a>&nbsp;&nbsp;" .
            $Cliente['cp_cliente'] .
            "</a>
      </span>
   </div>
   <!--Campo Teléfono -->
      <div class='col-lg-3 col-md-3 col-sm-12 col-xs-12'>
         <label>Teléfono:</label>
         <span class='input-group-text' style='background-color:white'>
         <i class='fas fa-phone-alt'></i>
         <a>&nbsp;&nbsp;" .
            $Cliente['tel_cliente'] .
            "</a>
         </span>
      </div>
    </div>
   <div class='row'>
      <!--Campo Correo -->
      <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
         <label>Correo:</label>
         <span class='input-group-text' style='background-color:white'>
         <i class='fas fa-at'></i>
         <a>&nbsp;&nbsp;" .
            $Cliente['mail_cliente'] .
            "</a>
         </span>
      </div>
      <!--Campo RFC -->
      <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
         <label>RFC:</label>
         <span class='input-group-text' style='background-color:white'>
         <i class='fas fa-address-card'></i>
         <a>&nbsp;&nbsp;" .
            $Cliente['rfc_cliente'] .
            "</a>
         </span>
      </div>
   </div>
   </fieldset>
   <br>
   <fieldset class='border p-2'>
    <legend  class='w-auto'>Datos del Servicio:</legend>
      <div class='row'>
         <div class='col-12'>
            <div class='row'>
               <!--Campo servicio -->
               <div class='col-xl-6 col-lg-9 col-md-6 col-sm-12 col-xs-6'>
                  <label>Tipo de servicio:</label>
                  <span class='input-group-text' style='background-color:white'>
                  <i class='fas fa-cogs'></i>
                  <a>&nbsp;&nbsp;" .
            $Orden['tipo_servicio'] .
            "</a>
                  </span>
               </div>
               <!--Campo Fecha -->
               <div class='col-xl-6 col-lg-9 col-md-6 col-sm-12 col-xs-6'>
                  <label>Fecha:</label>
                  <span class='input-group-text' style='background-color:white'>
                  <i class='fas fa-calendar-alt'></i>
                  <a>&nbsp;&nbsp;" .
            $Orden['fech_entrada'] .
            "</a>
                  </span>
               </div>
               <!--Campo Herramienta -->
               <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                  <label>Herramienta:</label>
                  <span class='input-group-text' style='background-color:white'>
                  <i class='fas fa-tools'></i>
                  <a>&nbsp;&nbsp;" .
            $Orden['desc_herramienta'] .
            "</a>
                  </span>
               </div>
            </div>
         </div>
         <div class='col-12'>
            <div class='row'>
               <!--Campo Marca -->
               <div class='col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12'>
                  <label>Marca:</label>
                  <span class='input-group-text' style='background-color:white'>
                  <i class='fas fa-tag'></i>
                  <a>&nbsp;&nbsp;" .
            $Orden['marca_herramienta'] .
            "</a>
                  </span>
               </div>
               <!--Campo Modelo -->
               <div class='col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12'>
                  <label>Modelo:</label>
                  <span class='input-group-text' style='background-color:white'>
                  <i class='fas fa-tags'></i>
                  <a>&nbsp;&nbsp;" .
            $Orden['mod_herramienta'] .
            "</a>
                  </span>
               </div>
               <!--Campo Adicional -->
               <div class='col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12'>
                  <label>Adicional:</label>
                  <span class='input-group-text' style='background-color:white'>
                  <i class='fas fa-puzzle-piece'></i>
                  <a>&nbsp;&nbsp;" .
            $Orden['tipo_herramienta'] .
            "</a>
                  </span>
               </div>
               <!--/. form producto -->
            </div>
            <div>
            </fieldset>
               <br>
               
               <!--/. form-->
            </div>
         </div>
      </div>

      <fieldset class='border p-2'>
      <legend class='w-auto'>Observaciones:</legend>
      " .
            nl2br($Orden['detalle_servicio']) .
            "
      </fieldset>
      

      <fieldset class='border p-2'>
      <legend class='w-auto'>Servicios:</legend>
      <table class='table table-borderless table-sm'>
    <thead>
      <tr>
        <th>Código</th>
        <th>Descrición</th>
        <th>Costo</th>
      </tr>
    </thead>
    <tbody>

     ";
    }
    $queryServicio = "select * from tab_ordenservicio where id_orden = $id";
    ($rsServicio = mysqli_query($con, $queryServicio)) or die("Error de consulta");
    while ($servicio = mysqli_fetch_array($rsServicio)) {
        echo "
   <tr>
      <td>" .
            $servicio['cod_servicio'] .
            "</td>
      <td>" .
            $servicio['desc_servicio'] .
            "</td>
      <td>$ " .
            $servicio['costo_servicio'] .
            ".00" .
            "</td>
    </tr>";
    }

    echo "
    </tbody>
      </table>
      </fieldset>
      
    <fieldset class='border p-2'>
    <legend class='w-auto'>Refacciones:</legend>
    <table class='table table-borderless table-sm'>
  <thead>
    <tr>
      <th>Código</th>
      <th>Descrición</th>
      <th>Marca</th>
      <th>Costo</th>
    </tr>
  </thead>
  <tbody>
            
      ";

    $queryRefaccion = "CAll Refacciones($id)";
    ($rsRefaccion = mysqli_query($con, $queryRefaccion)) or die("Error de consulta");
    while ($Refaccion = mysqli_fetch_array($rsRefaccion)) {
        echo "
   <tr>
      <td>" .
            $Refaccion['cod_refaccion'] .
            "</td>
      <td>" .
            $Refaccion['desc_refaccion'] .
            "</td>
      <td>" .
            $Refaccion['marca_refaccion'] .
            "</td>
      <td>$ " .
            $Refaccion['costo_refaccion'] .
            ".00" .
            "</td>
    </tr>";
    }

    echo "
      </tbody>
      </table>
      </fieldset>
      <br>";
        if ($_SESSION['priv_user']==2) {
            # code...
        }else{
            echo"
            <div class='row' >
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <form class='form' action='assets/controler/taller/goTaller.php' method='POST'>
                    <input type='hidden' name='formIdOrden' value=" . $id . " required>
                    <button type='submit' class='btn btn-outline-danger btn-block'><i class='fas fa-toolbox'></i></i> Enviar al Taller</button>
                 </div>
            </div>
            ";
        }
}
mysqli_close($con);
?>
