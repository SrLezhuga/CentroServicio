<?php 
require_once '../../vendor/dompdf/autoload.inc.php';
include("../conexion.php");

$queryFolio = "SELECT MAX(id_orden) FROM tab_orden";
$rsFolio = mysqli_query($con, $queryFolio) or die ("Error de consulta 1"); 
$Folio = mysqli_fetch_array($rsFolio);

echo $reporte=$Folio[0];

$queryOrden = "SELECT * FROM tab_orden WHERE id_orden =".$reporte; 
$rsOrden = mysqli_query($con, $queryOrden) or die ("Error de consulta 2"); 
$Orden = mysqli_fetch_array($rsOrden);
    
    $folio=$Orden['id_orden'];
    if(strlen($folio)==1){
        $folio="0000".$folio;
    }else if(strlen($folio)==2){
        $folio="000".$folio;
    }else if(strlen($folio)==3){
        $folio="00".$folio;
    }else if(strlen($folio)==4){
        $folio="0".$folio;
    }

$fecha= $Orden['fech_entrada'];

$items = explode("-", $fecha);
$dia=$items[2];
$mes=$items[1];
$año=$items[0];

switch ($mes) {
    case '01':
        $m="Enero";
        break;
    case '02':
        $m="Febrero";
        break;
    case '03':
        $m="Marzo";
        break;
    case '04':
        $m="Abril";
        break;
    case '05':
        $m="Mayo";
        break;
    case '06':
        $m="Junio";
        break;
     case '07':
        $m="Julio";
        break;
    case '08':
         $m="Agosto";
        break;        
    case '09':
        $m="Septiembre";
        break;
    case '10':
        $m="Octubre";
        break;
    case '11':
        $m="Noviembre";
        break;
    case '12':
        $m="Diciembre";
        break;
}

$fechaLetra =$dia . " de " . $m . " del " . $año;

$queryCliente = "SELECT * FROM tab_cliente WHERE id_cliente = ".$Orden['id_cliente']; 
$rsCliente = mysqli_query($con, $queryCliente) or die ("Error de consulta 3"); 
$Cliente = mysqli_fetch_array($rsCliente);

$queryMostrador = "SELECT name_user FROM tab_users WHERE code_user = ".$Orden['code_user']; 
$rsMostrador = mysqli_query($con, $queryMostrador) or die ("Error de consulta 3"); 
$Mostrador = mysqli_fetch_array($rsMostrador);

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

// instantiate and use the dompdf class
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$dompdf = new Dompdf($options);
$dompdf->loadHtml('
<!DOCTYPE html>
<html>
  <head>
    <title> Centro de Servicio MFA | Reporte</title>
    <link rel="icon" href="http://192.168.0.98/CentroServicio/assets/img/Logo/MFA.ico" />
  </head>
    <style>    
    @page {
            margin-top: 0.7em;
            margin-bottom: 0.3em;
        }
      *,
      *::before,
      *::after {
        box-sizing: border-box;
      }
      
      html {
        font-family: sans-serif;
        line-height: 1.15;
        -webkit-text-size-adjust: 100%;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
      }
      .display-1 {
        font-size: 0.7rem;
      }
      .display-2 {
        font-size: 1.5rem;
        font-weight: 300;
        line-height: 1.2;
        color: crimson;
      }
    .display-4 {
        font-size: 2rem;
        font-weight: 150;
      }
      .text-left {
        text-align: left !important;
      }
      
      .text-right {
        text-align: right !important;
      }
      
      .text-center {
        text-align: center !important;
      }
      .border {
        border: 1px solid #9E9E9E !important;
      }
      .border-info {
        border: 1px dashed  !important;
      }
      .border-out {
        border: 0px none  !important;
      }
      .row {
  display: flex;
  flex-wrap: wrap;
  margin-right: -0.75rem;
  margin-left: -0.75rem;
}
.no-gutters {
  margin-right: 0;
  margin-left: 0;
}

.no-gutters > .col,
.no-gutters > [class*="col-"] {
  padding-right: 0;
  padding-left: 0;
}

.col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col,
.col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm,
.col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md,
.col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg,
.col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl,
.col-xl-auto {
  position: relative;
  width: 100%;
  padding-right: 0.75rem;
  padding-left: 0.75rem;
}

.col {
  flex-basis: 0;
  flex-grow: 1;
  min-width: 0;
  max-width: 100%;
}
.col-1 {
  flex: 0 0 8.33333%;
  max-width: 8.33333%;
}

.col-2 {
  flex: 0 0 16.66667%;
  max-width: 16.66667%;
}

.col-3 {
  flex: 0 0 25%;
  max-width: 25%;
}

.col-4 {
  flex: 0 0 33.33333%;
  max-width: 33.33333%;
}

.col-5 {
  flex: 0 0 41.66667%;
  max-width: 41.66667%;
}

.col-6 {
  flex: 0 0 50%;
  max-width: 50%;
}

.col-7 {
  flex: 0 0 58.33333%;
  max-width: 58.33333%;
}

.col-8 {
  flex: 0 0 66.66667%;
  max-width: 66.66667%;
}

.col-9 {
  flex: 0 0 75%;
  max-width: 75%;
}

.col-10 {
  flex: 0 0 83.33333%;
  max-width: 83.33333%;
}

.col-11 {
  flex: 0 0 91.66667%;
  max-width: 91.66667%;
}

.col-12 {
  flex: 0 0 100%;
  max-width: 100%;
}
.offset-1 {
  margin-left: 8.33333%;
}

.offset-2 {
  margin-left: 16.66667%;
}

.offset-3 {
  margin-left: 25%;
}

.offset-4 {
  margin-left: 33.33333%;
}

.offset-5 {
  margin-left: 41.66667%;
}

.offset-6 {
  margin-left: 50%;
}

.offset-7 {
  margin-left: 58.33333%;
}

.offset-8 {
  margin-left: 66.66667%;
}

.offset-9 {
  margin-left: 75%;
}

.offset-10 {
  margin-left: 83.33333%;
}

.offset-11 {
  margin-left: 91.66667%;
}
hr {
    color: #f8b500;
    border:1px dashed;
}
img {
  position: absolute; 
  z-index: 0; 
  opacity: 0.20; 
  filter: grayscale(1);
  height: 450px;
  padding-left: 10em;
}
.img-top {
  margin-top: 2em;
}
a {
  font-size: 0.8rem;
}
label {
  font-size: 0.8rem;
}
.page-break {
  page-break-after: always;
  border: 0;
  margin: 0;
  padding: 0;
}
    </style>
    <body>
        <div class="container-fluid">
            <img class="img-top" src="http://192.168.0.98/CentroServicio/assets/img/Logo/logo.png" />
            <div class="row"  style="height: 3.5rem;">
                <div class="col-8">
                    <h1 class="display-4 text-right"><strong>Centro de servicio</strong></h1>
                </div>
                <div class="col-4 offset-8 text-right">
                    <a class="display-2"><strong>FOLIO:'.$folio.'</strong></a><br>
                    <a>'.$fechaLetra.'</a>
                </div>
            </div>
            <div class="row" style="height: 4rem;">
                <div class="col-8">
                  <a>
                    <strong>Mayoreo Ferretero Atlas S.A. de C.V.</strong>
                    <br />
                    <b>RFC MFA030403T73</b>
                    <br />
                    Guadalupe Victoria #55 Bodega Outlet
                    <br />
                    Tel: 33450116 ext 124 
                    <br />
                  </a>
                </div>
                <div class="col-4 offset-8 text-right">
                  <h3>
                    <b>Mostrador</b>
                    <br>
                  </h3>
                </div>
            </div>
            <fieldset class="border p-2" style="height: 3.5rem;">
                <legend class="w-auto"><a><strong>Datos del Cliente:</strong></a></legend>
                <div class="row">
                    <div class="col-6">
                      <a>
                        <b>Nombre:</b>'.$Cliente['nom_cliente'].'
                        <br />
                        <b>Domicilio:</b>'.$Cliente['dir_cliente'].'
                        <br />
                        <b>Colonia:</b>'.$Cliente['col_cliente'].'
                        <br />
                        <b>Municipio:</b>'.$Cliente['mun_cliente'].'
                        <br />
                      </a>
                    </div>
                    <div class="col-6 offset-6">
                      <a>
                        <b>Teléfono:</b>'.$Cliente['tel_cliente'].'
                        <br />
                        <b>C.P:</b>'.$Cliente['cp_cliente'].'
                        <br />
                        <b>Correo:</b>'.$Cliente['mail_cliente'].'
                        <br />
                        <b>RFC:</b>'.$Cliente['rfc_cliente'].'
                        <br />
                      </a>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2" style="height: 2.5rem;">
                <legend class="w-auto"><a><strong>Datos del Servicio:</strong></a></legend>
                <div class="row">
                    <div class="col-6">
                      <a>
                        <b>Servicio:</b>'.$Orden['tipo_servicio'].'
                        <br />
                        <b>Herramienta:</b>'.$Orden['desc_herramienta'].'
                        <br />
                        <b>Modelo:</b>'.$Orden['mod_herramienta'].'
                        <br />
                      </a>
                    </div>
                    <div class="col-6 offset-6">
                      <a>
                        <b>Fecha:</b>
                        '.$Orden['fech_entrada'].'
                        <br />
                        <b>Marca:</b>
                        '.$Orden['marca_herramienta'].'
                        <br />
                        <b>Serie:</b>
                        '.$Orden['serie_herramienta'].'
                        <br />
                      </a>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2" style="height: 2.5rem;">
                <legend class="w-auto"><a><strong>Complementarios:</strong></a></legend>
                  <a>
                    '.$Orden['complementarios'].'
                    <br />
                  </a>
            </fieldset>    
            <div class="row"  style="height: 4.2rem;">
              <div class="col-6 text-center" >
                <a>
                  <br>Mostrador
                  <br>_______________________
                  <br>'.$Mostrador['name_user'].'
                  <br>
                  <br>
                </a>
              </div>
              <div class="col-6 offset-6 text-center" >
                <a>
                  <br>Cliente
                  <br>_______________________
                  <br>'.$Cliente['nom_cliente'].'
                  <br>
                  <br>
                </a>
              </div>
            </div>
            <div class="col-12">
              <a class="display-1">
                Por favor conserve este comprobante ya que de lo contrario no se podrá hacer entrega de su producto; Le recordamos
                recoger su producto dentro de los 30 días naturales después de haber sido reparado, pasado 90 días naturales,
                <b>Mayoreo Ferretero Atlas</b> no se hace responsable del producto. Cualquier revision que no sea garantia, causara
                honorarios.
                <br>
              </a>
            </div>
        </div>
        <br>
        <br>
        <hr>
        <br>





        <div class="container-fluid " >
          <img class="img-top" src="http://192.168.0.98/CentroServicio/assets/img/Logo/logo.png" />
              <div class="row"  style="height: 3.5rem;">
                  <div class="col-8">
                      <h1 class="display-4 text-right"><strong>Centro de servicio</strong></h1>
                  </div>
                  <div class="col-4 offset-8 text-right">
                      <a class="display-2"><strong>FOLIO:'.$folio.'</strong></a><br>
                      <a>'.$fechaLetra.'</a>
                  </div>
              </div>
              <div class="row" style="height: 4rem;">
                  <div class="col-8">
                    <a>
                      <strong>Mayoreo Ferretero Atlas S.A. de C.V.</strong>
                      <br />
                      <b>RFC MFA030403T73</b>
                      <br />
                      Guadalupe Victoria #55 Bodega Outlet
                      <br />
                      Tel: 33450116 ext 124 
                      <br />
                    </a>
                  </div>
                  <div class="col-4 offset-8 text-right">
                    <h3>
                      <b>Cliente</b>
                      <br>
                    </h3>
                  </div>
              </div>
              <fieldset class="border p-2" style="height: 3.5rem;">
                  <legend class="w-auto"><a><strong>Datos del Cliente:</strong></a></legend>
                  <div class="row">
                      <div class="col-6">
                        <a>
                          <b>Nombre:</b>'.$Cliente['nom_cliente'].'
                          <br />
                          <b>Domicilio:</b>'.$Cliente['dir_cliente'].'
                          <br />
                          <b>Colonia:</b>'.$Cliente['col_cliente'].'
                          <br />

                          <b>Municipio:</b>'.$Cliente['mun_cliente'].'
                          <br />
                        </a>
                      </div>
                      <div class="col-6 offset-6">
                        <a>
                          <b>Teléfono:</b>'.$Cliente['tel_cliente'].'
                          <br />
                          <b>C.P:</b>'.$Cliente['cp_cliente'].'
                          <br />
                          <b>Correo:</b>'.$Cliente['mail_cliente'].'
                          <br />
                          <b>RFC:</b>'.$Cliente['rfc_cliente'].'
                          <br />
                        </a>
                      </div>
                  </div>
              </fieldset>
              <fieldset class="border p-2" style="height: 2.5rem;">
                  <legend class="w-auto"><a><strong>Datos del Servicio:</strong></a></legend>
                  <div class="row">
                      <div class="col-6">
                        <a>
                          <b>Servicio:</b>'.$Orden['tipo_servicio'].'
                          <br />
                          <b>Herramienta:</b>'.$Orden['desc_herramienta'].'
                          <br />
                          <b>Modelo:</b>'.$Orden['mod_herramienta'].'
                          <br />
                        </a>
                      </div>
                      <div class="col-6 offset-6">
                        <a>
                          <b>Fecha:</b>
                          '.$Orden['fech_entrada'].'
                          <br />
                          <b>Marca:</b>
                          '.$Orden['marca_herramienta'].'
                          <br />
                          <b>Serie:</b>
                          '.$Orden['serie_herramienta'].'
                          <br />
                        </a>
                      </div>
                  </div>
              </fieldset>
              <fieldset class="border p-2" style="height: 2.5rem;">
                  <legend class="w-auto"><a><strong>Complementarios:</strong></a></legend>
                    <a>
                      '.$Orden['complementarios'].'
                      <br />
                    </a>
              </fieldset>    
              <div class="row"  style="height: 4.2rem;">
                <div class="col-6 text-center" >
                  <a>
                    <br>Mostrador
                    <br>_______________________
                    <br>'.$Mostrador['name_user'].'
                    <br>
                    <br>
                  </a>
                </div>
                <div class="col-6 offset-6 text-center" >
                  <a>
                    <br>Cliente
                    <br>_______________________
                    <br>'.$Cliente['nom_cliente'].'
                    <br>
                    <br>
                  </a>
                </div>
              </div>
              <div class="col-12">
                <a class="display-1">
                  Por favor conserve este comprobante ya que de lo contrario no se podrá hacer entrega de su producto; Le recordamos
                  recoger su producto dentro de los 30 días naturales después de haber sido reparado, pasado 90 días naturales,
                  <b>Mayoreo Ferretero Atlas</b> no se hace responsable del producto. Cualquier revision que no sea garantia, causara
                  honorarios.
                  <br>
                </a>
              </div>
        </div>


<p class="page-break"></p>


        <div class="container-fluid" >
        <img  class="img-top" src="http://192.168.0.98/CentroServicio/assets/img/Logo/logo.png" />
            <div class="row"  style="height: 3.5rem;">
                <div class="col-8">
                    <h1 class="display-4 text-right"><strong>Centro de servicio</strong></h1>
                </div>
                <div class="col-4 offset-8 text-right">
                    <a class="display-2"><strong>FOLIO:'.$folio.'</strong></a><br>
                    <a>'.$fechaLetra.'</a>
                </div>
            </div>
            <div class="row" style="height: 4rem;">
                <div class="col-8">
                  <a>
                    <strong>Mayoreo Ferretero Atlas S.A. de C.V.</strong>
                    <br />
                    <b>RFC MFA030403T73</b>
                    <br />
                    Guadalupe Victoria #55 Bodega Outlet
                    <br />
                    Tel: 33450116 ext 124 
                    <br />
                  </a>
                </div>
                <div class="col-4 offset-8 text-right">
                  <h3>
                    <b>Control</b>
                    <br>
                  </h3>
                </div>
            </div>
            <fieldset class="border p-2" style="height: 3.5rem;">
                <legend class="w-auto"><a><strong>Datos del Cliente:</strong></a></legend>
                <div class="row">
                    <div class="col-6">
                      <a>
                        <b>Nombre:</b>'.$Cliente['nom_cliente'].'
                        <br />
                        <b>Domicilio:</b>'.$Cliente['dir_cliente'].'
                        <br />
                        <b>Colonia:</b>'.$Cliente['col_cliente'].'
                        <br />
                        <b>Municipio:</b>'.$Cliente['mun_cliente'].'
                        <br />
                      </a>
                    </div>
                    <div class="col-6 offset-6">
                      <a>
                        <b>Teléfono:</b>'.$Cliente['tel_cliente'].'
                        <br />
                        <b>C.P:</b>'.$Cliente['cp_cliente'].'
                        <br />
                        <b>Correo:</b>'.$Cliente['mail_cliente'].'
                        <br />
                        <b>RFC:</b>'.$Cliente['rfc_cliente'].'
                        <br />
                      </a>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2" style="height: 2.5rem;">
                <legend class="w-auto"><a><strong>Datos del Servicio:</strong></a></legend>
                <div class="row">
                    <div class="col-6">
                      <a>
                        <b>Servicio:</b>'.$Orden['tipo_servicio'].'
                        <br />
                        <b>Herramienta:</b>'.$Orden['desc_herramienta'].'
                        <br />
                        <b>Modelo:</b>'.$Orden['mod_herramienta'].'
                        <br />
                      </a>
                    </div>
                    <div class="col-6 offset-6">
                      <a>
                        <b>Fecha:</b>
                        '.$Orden['fech_entrada'].'
                        <br />
                        <b>Marca:</b>
                        '.$Orden['marca_herramienta'].'
                        <br />
                        <b>Serie:</b>
                        '.$Orden['serie_herramienta'].'
                        <br />
                      </a>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2" style="height: 2.5rem;">
                <legend class="w-auto"><a><strong>Complementarios:</strong></a></legend>
                  <a>
                    '.$Orden['complementarios'].'
                    <br />
                  </a>
            </fieldset>    
            <div class="row"  style="height: 4.2rem;">
              <div class="col-6 text-center" >
                <a>
                  <br>Mostrador
                  <br>_______________________
                  <br>'.$Mostrador['name_user'].'
                  <br>
                  <br>
                </a>
              </div>
              <div class="col-6 offset-6 text-center" >
                <a>
                  <br>Cliente
                  <br>_______________________
                  <br>'.$Cliente['nom_cliente'].'
                  <br>
                  <br>
                </a>
              </div>
            </div>
            <div class="col-12">
              <a class="display-1">
                Por favor conserve este comprobante ya que de lo contrario no se podrá hacer entrega de su producto; Le recordamos
                recoger su producto dentro de los 30 días naturales después de haber sido reparado, pasado 90 días naturales,
                <b>Mayoreo Ferretero Atlas</b> no se hace responsable del producto. Cualquier revision que no sea garantia, causara
                honorarios.
                <br>
              </a>
            </div>
        </div>
        <br>
        <br>
        <hr>
        <br>






        <div class="container-fluid " >
          <img class="img-top" src="http://192.168.0.98/CentroServicio/assets/img/Logo/logo.png" />
              <div class="row"  style="height: 3.5rem;">
                  <div class="col-8">
                      <h1 class="display-4 text-right"><strong>Centro de servicio</strong></h1>
                  </div>
                  <div class="col-4 offset-8 text-right">
                      <a class="display-2"><strong>FOLIO:'.$folio.'</strong></a><br>
                      <a>'.$fechaLetra.'</a>
                  </div>
              </div>
              <div class="row" style="height: 4rem;">
                  <div class="col-8">
                    <a>
                      <strong>Mayoreo Ferretero Atlas S.A. de C.V.</strong>
                      <br />
                      <b>RFC MFA030403T73</b>
                      <br />
                      Guadalupe Victoria #55 Bodega Outlet
                      <br />
                      Tel: 33450116 ext 124 
                      <br />
                    </a>
                  </div>
                  <div class="col-4 offset-8 text-right">
                    <h3>
                      <b>Taller</b>
                      <br>
                    </h3>
                  </div>
              </div>
              <fieldset class="border p-2" style="height: 3.5rem;">
                  <legend class="w-auto"><a><strong>Datos del Cliente:</strong></a></legend>
                  <div class="row">
                      <div class="col-6">
                        <a>
                          <b>Nombre:</b>'.$Cliente['nom_cliente'].'
                          <br />
                          <b>Domicilio:</b>'.$Cliente['dir_cliente'].'
                          <br />
                          <b>Colonia:</b>'.$Cliente['col_cliente'].'
                          <br />

                          <b>Municipio:</b>'.$Cliente['mun_cliente'].'
                          <br />
                        </a>
                      </div>
                      <div class="col-6 offset-6">
                        <a>
                          <b>Teléfono:</b>'.$Cliente['tel_cliente'].'
                          <br />
                          <b>C.P:</b>'.$Cliente['cp_cliente'].'
                          <br />
                          <b>Correo:</b>'.$Cliente['mail_cliente'].'
                          <br />
                          <b>RFC:</b>'.$Cliente['rfc_cliente'].'
                          <br />
                        </a>
                      </div>
                  </div>
              </fieldset>
              <fieldset class="border p-2" style="height: 2.5rem;">
                  <legend class="w-auto"><a><strong>Datos del Servicio:</strong></a></legend>
                  <div class="row">
                      <div class="col-6">
                        <a>
                          <b>Servicio:</b>'.$Orden['tipo_servicio'].'
                          <br />
                          <b>Herramienta:</b>'.$Orden['desc_herramienta'].'
                          <br />
                          <b>Modelo:</b>'.$Orden['mod_herramienta'].'
                          <br />
                        </a>
                      </div>
                      <div class="col-6 offset-6">
                        <a>
                          <b>Fecha:</b>
                          '.$Orden['fech_entrada'].'
                          <br />
                          <b>Marca:</b>
                          '.$Orden['marca_herramienta'].'
                          <br />
                          <b>Serie:</b>
                          '.$Orden['serie_herramienta'].'
                          <br />
                        </a>
                      </div>
                  </div>
              </fieldset>
              <fieldset class="border p-2" style="height: 2.5rem;">
                  <legend class="w-auto"><a><strong>Complementarios:</strong></a></legend>
                    <a>
                      '.$Orden['complementarios'].'
                      <br />
                    </a>
              </fieldset>    
              <div class="row"  style="height: 4.2rem;">
                <div class="col-6 text-center" >
                  <a>
                    <br>Mostrador
                    <br>_______________________
                    <br>'.$Mostrador['name_user'].'
                    <br>
                    <br>
                  </a>
                </div>
                <div class="col-6 offset-6 text-center" >
                  <a>
                    <br>Cliente
                    <br>_______________________
                    <br>'.$Cliente['nom_cliente'].'
                    <br>
                    <br>
                  </a>
                </div>
              </div>
              <div class="col-12">
                <a class="display-1">
                  Por favor conserve este comprobante ya que de lo contrario no se podrá hacer entrega de su producto; Le recordamos
                  recoger su producto dentro de los 30 días naturales después de haber sido reparado, pasado 90 días naturales,
                  <b>Mayoreo Ferretero Atlas</b> no se hace responsable del producto. Cualquier revision que no sea garantia, causara
                  honorarios.
                  <br>
                </a>
              </div>
        </div>
    </body> 
</html>
');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('Letter', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser

$dompdf->stream('document.pdf',array('Attachment'=>0));

?>