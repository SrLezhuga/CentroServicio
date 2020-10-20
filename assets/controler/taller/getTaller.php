<?php
   session_start();
   include("../conexion.php");
   $id = $_GET['id'];
   
   $queryOrden = "SELECT *  FROM tab_orden WHERE id_orden =".$id;
   $rsOrden = mysqli_query($con, $queryOrden) or die("Error de consulta");
   while ($Orden = mysqli_fetch_array($rsOrden)) {
       
       $folio = $Orden[id_orden];
       if (strlen($folio) == 1) {
           $folio = "0000" . $folio;
       } else if (strlen($folio) == 2) {
           $folio = "000" . $folio;
       } else if (strlen($folio) == 3) {
           $folio = "00" . $folio;
       } else if (strlen($folio) == 4) {
           $folio = "0" . $folio;
       }
   
       $queryCliente = "SELECT * FROM tab_cliente WHERE id_cliente = $Orden[id_cliente]";
       $rsCliente = mysqli_query($con, $queryCliente) or die("Error de consulta");
       while ($Cliente = mysqli_fetch_array($rsCliente)) {
           
   echo "
   <h3 style='color: crimson; text-align: right;'><b>Folio: </b>".$folio."</h3>
   <fieldset class='border p-2'>
    <legend  class='w-auto'>Datos del Cliente:</legend>
   <div class='row'>
      <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
         <label>Cliente:</label>
         <span class='input-group-text' style='background-color:white'>
         <i class='fas fa-user-alt'></i>
         <a>&nbsp;&nbsp;".$Cliente[nom_cliente]."</a>
         </span>
      </div>
      <!--Campo Domicilio -->
      <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
         <label>Domicilio:</label>
         <span class='input-group-text' style='background-color:white'>
         <i class='fas fa-home'></i>
         <a>&nbsp;&nbsp;".$Cliente[dir_cliente]."</a>
         </span>
      </div>
   </div>
   <div class='row'>
    <!--Campo municipio -->
    <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
      <label>Municipio:</label>
      <span class='input-group-text' style='background-color:white'>
         <i class='fas fa-map-marker-alt'></i>
      <a>&nbsp;&nbsp;".$Cliente[mun_cliente]."</a>
      </span>
   </div>
    <!--Campo Codigo Postal -->
    <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
      <label>Codigo Postal:</label>
      <span class='input-group-text' style='background-color:white'>
         <i class='fas fa-hashtag'></i>
      <a>&nbsp;&nbsp;".$Cliente[cp_cliente]."</a>
      </span>
   </div>
    </div>
   <div class='row'>
      <!--Campo Teléfono -->
      <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
         <label>Teléfono:</label>
         <span class='input-group-text' style='background-color:white'>
         <i class='fas fa-phone-alt'></i>
         <a>&nbsp;&nbsp;".$Cliente[tel_cliente]."</a>
         </span>
      </div>
      <!--Campo RFC -->
      <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
         <label>RFC:</label>
         <span class='input-group-text' style='background-color:white'>
         <i class='fas fa-address-card'></i>
         <a>&nbsp;&nbsp;".$Cliente[rfc_cliente]."</a>
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
                  <a>&nbsp;&nbsp;".$Orden[tipo_servicio]."</a>
                  </span>
               </div>
               <!--Campo Fecha -->
               <div class='col-xl-6 col-lg-9 col-md-6 col-sm-12 col-xs-6'>
                  <label>Fecha:</label>
                  <span class='input-group-text' style='background-color:white'>
                  <i class='fas fa-calendar-alt'></i>
                  <a>&nbsp;&nbsp;".$Orden[fech_entrada]."</a>
                  </span>
               </div>
               <!--Campo Herramienta -->
               <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                  <label>Herramienta:</label>
                  <span class='input-group-text' style='background-color:white'>
                  <i class='fas fa-tools'></i>
                  <a>&nbsp;&nbsp;".$Orden[desc_herramienta]."</a>
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
                  <a>&nbsp;&nbsp;".$Orden[marca_herramienta]."</a>
                  </span>
               </div>
               <!--Campo Modelo -->
               <div class='col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12'>
                  <label>Modelo:</label>
                  <span class='input-group-text' style='background-color:white'>
                  <i class='fas fa-tags'></i>
                  <a>&nbsp;&nbsp;".$Orden[mod_herramienta]."</a>
                  </span>
               </div>
               <!--Campo Adicional -->
               <div class='col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12'>
                  <label>Adicional:</label>
                  <span class='input-group-text' style='background-color:white'>
                  <i class='fas fa-puzzle-piece'></i>
                  <a>&nbsp;&nbsp;".$Orden[tipo_herramienta]."</a>
                  </span>
               </div>
               <!--Campo Observaciones -->
               <div class='col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12'>
                  <label>Observaciones:</label>
                  <span class='input-group-text' style='background-color:white'>
                  <i class='fas fa-tasks'></i>
                  <a>&nbsp;&nbsp;".$Orden[obs_herramienta]."</a>
                  </span>
               </div>
               <!--Campo costo -->
               <div class='col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12'>
                  <label>Costo Por Revision:</label>
                  <span class='input-group-text' style='background-color:white'>
                  <i class='fas fa-dollar-sign'></i>
                  <a>&nbsp;&nbsp;".$Orden[costo_servicio].".00</a>
                  </span>
               </div>
               <!--/. form producto -->
            </div>
            <div>
            </fieldset>
            </div>
         </div>
      </div>
   ";
   
   }
   }
   
   mysqli_close($con);
?>