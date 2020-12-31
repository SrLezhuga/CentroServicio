<?php 
require_once '../../vendor/PHPMailer/src/Exception.php';
require_once '../../vendor/PHPMailer/src/PHPMailer.php';
require_once '../../vendor/PHPMailer/src/SMTP.php';
require_once '../../vendor/dompdf/autoload.inc.php';
include("../conexion.php");
require_once "traslate.php";

// reference the PHPMailer namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP; 

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

$reporte=$_POST['reporte'];
$recibe=$_POST['recibe'];
$mostrador=$_POST['mostrador'];
$clienteMail=$_POST['mail'];
$pago=$_POST['pago'];

$condicion=$_POST['condicion'];
$correoOn="off";
if (isset($_POST['correo']) && $_POST['correo'] == 'on'){
  $correoOn="on";
}
$facturaOn="on";

$fecha=$_POST['fecha'];

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


$queryOrden = "SELECT * FROM tab_orden WHERE id_orden =".$reporte; 
$rsOrden = mysqli_query($con, $queryOrden) or die ("Error de consulta"); 
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

$queryCliente = "SELECT * FROM tab_cliente WHERE id_cliente = ".$Orden['id_cliente']; 
$rsCliente = mysqli_query($con, $queryCliente) or die ("Error de consulta"); 
$Cliente = mysqli_fetch_array($rsCliente);


if ($Orden['tipo_servicio']=="Garantia" ||$Orden['tipo_servicio']=="Mantenimiento/Garantía" ) {
  $queryRefaccion = "SELECT * FROM tab_ordenrefaccion WHERE id_orden = ".$reporte; 
  $rsRefaccion = mysqli_query($con, $queryRefaccion) or die ("Error de consulta"); 

  for ($i=0; $i < 10 ; $i++) { 
      $itemRef[$i] = [ 'cod_refaccion' => '&nbsp;', 'desc_refaccion' => '&nbsp;', 'costo_refaccion' => '&nbsp;' ];
  }
  $i=0;
  while($Refaccion = mysqli_fetch_array($rsRefaccion)){
      
      $itemRef[$i]['cod_refaccion']=$Refaccion['cod_refaccion'];
      $itemRef[$i]['desc_refaccion']=$Refaccion['desc_refaccion'];
      $itemRef[$i]['costo_refaccion']="&nbsp;";
      $i++;
  }
  $queryServicio = "SELECT * FROM tab_ordenservicio WHERE id_orden = ".$reporte; 
  $rsServicio = mysqli_query($con, $queryServicio) or die ("Error de consulta"); 

  for ($i=0; $i < 10 ; $i++) { 
      $itemSer[$i] = [ 'desc_servicio' => '&nbsp;', 'costo_servicio' => '&nbsp;' ];
  }
  $i=0;
  while($Servicio = mysqli_fetch_array($rsServicio)){
      
      $itemSer[$i]['desc_servicio']=$Servicio['desc_servicio'];
      $itemSer[$i]['costo_servicio']="&nbsp;";
      $i++;
  }
}else {
  $queryRefaccion = "SELECT * FROM tab_ordenrefaccion WHERE id_orden = ".$reporte; 
  $rsRefaccion = mysqli_query($con, $queryRefaccion) or die ("Error de consulta"); 

  for ($i=0; $i < 10 ; $i++) { 
      $itemRef[$i] = [ 'cod_refaccion' => '&nbsp;', 'desc_refaccion' => '&nbsp;', 'costo_refaccion' => '&nbsp;' ];
  }
  $i=0;
  while($Refaccion = mysqli_fetch_array($rsRefaccion)){
      
      $itemRef[$i]['cod_refaccion']=$Refaccion['cod_refaccion'];
      $itemRef[$i]['desc_refaccion']=$Refaccion['desc_refaccion'];
      $itemRef[$i]['costo_refaccion']="$ ".$Refaccion['costo_refaccion'];
      $i++;
  }

  $queryServicio = "SELECT * FROM tab_ordenservicio WHERE id_orden = ".$reporte; 
  $rsServicio = mysqli_query($con, $queryServicio) or die ("Error de consulta"); 

  for ($i=0; $i < 10 ; $i++) { 
      $itemSer[$i] = [ 'desc_servicio' => '&nbsp;', 'costo_servicio' => '&nbsp;' ];
  }
  $i=0;
  while($Servicio = mysqli_fetch_array($rsServicio)){
      
      $itemSer[$i]['desc_servicio']=$Servicio['desc_servicio'];
      $itemSer[$i]['costo_servicio']="$ ".$Servicio['costo_servicio'];
      $i++;
  }
}

$queryServicio = "SELECT * FROM tab_ordenservicio WHERE id_orden = ".$reporte; 
$rsServicio = mysqli_query($con, $queryServicio) or die ("Error de consulta"); 

for ($i=0; $i < 10 ; $i++) { 
    $itemSer[$i] = [ 'desc_servicio' => '&nbsp;', 'costo_servicio' => '&nbsp;' ];
}
$i=0;
while($Servicio = mysqli_fetch_array($rsServicio)){
    
    $itemSer[$i]['desc_servicio']=$Servicio['desc_servicio'];
    $itemSer[$i]['costo_servicio']="$ ".$Servicio['costo_servicio'];
    $i++;
}

$querySumRef = "SELECT SUM(costo_refaccion) FROM tab_ordenrefaccion WHERE id_orden = ".$reporte; 
$rsSumRef = mysqli_query($con, $querySumRef) or die ("Error de consulta"); 
$SumRef = mysqli_fetch_array($rsSumRef);

$querySumSer = "SELECT SUM(costo_servicio) FROM tab_ordenservicio WHERE id_orden = ".$reporte; 
$rsSumSer = mysqli_query($con, $querySumSer) or die ("Error de consulta"); 
$SumSer = mysqli_fetch_array($rsSumSer);


if ($facturaOn=="on") {
  $total=(($SumRef[0]+$SumSer[0])*.16);
  $totalIva=(($SumRef[0]+$SumSer[0])*1.16);
  $iva="Si";
}else{
  $total=0;
  $totalIva=($SumRef[0]+$SumSer[0]);
  $iva="No";
}

$totalEnLetra=convertir($totalIva);

if ($pago=="SIN CARGO") {
  $total=0;
  $totalIva=0;
  $SumRef[0]=0;
  $totalEnLetra="Cortesía de Mayoreo Ferretero Atlas";
}

if ($condicion=="POSPAGO") {
  $total=0;
  $totalIva=0;
  $SumRef[0]=0;
  $totalEnLetra="La orden se enviara a ruta y liquidara en sucursal";
}

if ($Orden['tipo_servicio']=="Garantia" ||$Orden['tipo_servicio']=="Mantenimiento/Garantía" ) {
  $SumRef[0]=0;
  $total=0;
  $totalIva=0;
  $SumSer[0]=0;
  $totalEnLetra="La garantia cubre los gastos";
}

$sql = "UPDATE tab_orden
            SET   status_orden  = 'ENTREGADA',
                  pago_orden    = '" . $pago . "',
                  iva_orden    = '" . $iva . "'
            WHERE id_orden      = " . $reporte . ";";

mysqli_query($con, $sql);

$html =  '<html>
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
height: px;
border:1px dashed;
}
img {
  position: absolute; 
  z-index: 0; 
  opacity: 0.20; 
  filter: grayscale(1);
  margin-top: 7em;
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
        <img src="http://192.168.0.98/CentroServicio/assets/img/Logo/logo.png" />
        <div class="container-fluid">
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
            </div>
        </div>
            </div>
            <fieldset class="border p-2" style="height: 3.5rem;">
                <legend class="w-auto"><a><b>Datos del Cliente:</b></a></legend>
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
                <legend class="w-auto"><a><b>Datos del Servicio:</b></a></legend>
                <div class="row">
                    <div class="col-8">
                      <a>
                        <b>Servicio:</b>'.$Orden['tipo_servicio'].'
                        <br />
                        <b>Herramienta:</b>'.$Orden['desc_herramienta'].'
                        <br />
                        <b>Modelo:</b>'.$Orden['mod_herramienta'].'
                        <br />
                      </a>
                    </div>
                    <div class="col-4 offset-8">
                      <a>
                        <b>Fecha:</b>'.$Orden['fech_entrada'].'
                        <br />
                        <b>Marca:</b>'.$Orden['marca_herramienta'].'
                        <br />
                        <b>Serie:</b>'.$Orden['serie_herramienta'].'
                        <br />
                      </a>
                    </div>
                </div>
            </fieldset>
            <div class="row"  style="height: 13rem;">
                <div class="col-7">
                    <fieldset class="border p-2">
                        <legend class="w-auto"><b><a>Refacciones Utilizadas:</b></a></legend>
                        <table class="table table-borderless table-sm"  width="100%" cellspacing="0">
                            <tbody>
                            <tr>
                            <td><a>'.$itemRef[0]['cod_refaccion'].' '.$itemRef[0]['desc_refaccion'].'</a></td>
                            <td><a>'.$itemRef[0]['costo_refaccion'].'</a></td>
                        </tr>
                        <tr>
                            <td><a>'.$itemRef[1]['cod_refaccion'].' '.$itemRef[1]['desc_refaccion'].'</a></td>
                            <td><a>'.$itemRef[1]['costo_refaccion'].'</a></td>
                        </tr>
                        <tr>
                            <td><a>'.$itemRef[2]['cod_refaccion'].' '.$itemRef[2]['desc_refaccion'].'</a></td>
                            <td><a>'.$itemRef[2]['costo_refaccion'].'</a></td>
                        </tr>
                        <tr>
                            <td><a>'.$itemRef[3]['cod_refaccion'].' '.$itemRef[3]['desc_refaccion'].'</a></td>
                            <td><a>'.$itemRef[3]['costo_refaccion'].'</a></td>
                        </tr>
                        <tr>
                            <td><a>'.$itemRef[4]['cod_refaccion'].' '.$itemRef[4]['desc_refaccion'].'</a></td>
                            <td><a>'.$itemRef[4]['costo_refaccion'].'</a></td>
                        </tr>
                        <tr>
                          <td><a>'.$itemRef[5]['cod_refaccion'].' '.$itemRef[5]['desc_refaccion'].'</a></td>
                          <td><a>'.$itemRef[5]['costo_refaccion'].'</a></td>
                        </tr>
                        <tr>
                          <td><a>'.$itemRef[6]['cod_refaccion'].' '.$itemRef[6]['desc_refaccion'].'</a></td>
                          <td><a>'.$itemRef[6]['costo_refaccion'].'</a></td>
                        </tr>
                        <tr>
                          <td><a>'.$itemRef[7]['cod_refaccion'].' '.$itemRef[7]['desc_refaccion'].'</a></td>
                          <td><a>'.$itemRef[7]['costo_refaccion'].'</a></td>
                        </tr>
                        <tr>
                          <td><a>'.$itemRef[8]['cod_refaccion'].' '.$itemRef[8]['desc_refaccion'].'</a></td>
                          <td><a>'.$itemRef[8]['costo_refaccion'].'</a></td>
                        </tr>
                        <tr>
                          <td><a>'.$itemRef[9]['cod_refaccion'].' '.$itemRef[9]['desc_refaccion'].'</a></td>
                          <td><a>'.$itemRef[9]['costo_refaccion'].'</a></td>
                        </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
                <div class="col-5 offset-7">
                    <fieldset class="border p-2">
                        <legend class="w-auto"><a><b>Servicios:</b></a></legend>
                        <table class="table table-borderless table-sm" width="100%" cellspacing="0">
                            
                            <tbody>
                                <tr>
                                    <td><a>'.$itemSer[0]['desc_servicio'].'</a></td>
                                    <td><a>'.$itemSer[0]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                    <td><a>'.$itemSer[1]['desc_servicio'].'</a></td>
                                    <td><a>'.$itemSer[1]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                    <td><a>'.$itemSer[2]['desc_servicio'].'</a></td>
                                    <td><a>'.$itemSer[2]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                    <td><a>'.$itemSer[3]['desc_servicio'].'</a></td>
                                    <td><a>'.$itemSer[3]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                    <td><a>'.$itemSer[4]['desc_servicio'].'</a></td>
                                    <td><a>'.$itemSer[4]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                  <td><a>'.$itemSer[4]['desc_servicio'].'</a></td>
                                  <td><a>'.$itemSer[4]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                  <td><a>'.$itemSer[5]['desc_servicio'].'</a></td>
                                  <td><a>'.$itemSer[5]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                  <td><a>'.$itemSer[6]['desc_servicio'].'</a></td>
                                  <td><a>'.$itemSer[6]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                  <td><a>'.$itemSer[7]['desc_servicio'].'</a></td>
                                  <td><a>'.$itemSer[7]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                  <td><a>'.$itemSer[8]['desc_servicio'].'</a></td>
                                  <td><a>'.$itemSer[8]['costo_servicio'].'</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
            <fieldset class="border p-2" style="height: 2.5rem;">
              <legend class="w-auto"><b><a>Observaciones del Servicio:</b></a></legend>
                <a>
                  '.$Orden['detalle_servicio'].'
                  <br />
                </a>
            </fieldset>
            <fieldset class="border p-2" style="height: 2.5rem;">
                <legend class="w-auto"><a><b>Complementarios:</b></a></legend>
                  <a>
                    '.$Orden['complementarios'].'
                    <br />
                  </a>
            </fieldset> 
            <div class="row"  style="height: 4.8rem;">
                <div class="col-5" >
                    <fieldset class="border p-2" style="height: 2.5rem;">
                      <legend class="w-auto"><a><b>Conceptos de pago:</b></a></legend>
                      <a>
                        <b>Tipo de pago:</b> '.$pago.'
                        <br>
                        <b>Forma de pago:</b> UNA EXHIBICIÓN
                        <br>
                        <b>Condiciones de pago:</b> '.$condicion.'
                        <br>
                      </a>
                    </fieldset>
                </div>
                <div class="col-4 offset-5">
                    <fieldset class="border p-2" style="height: 2.5rem;">
                        <legend class="w-auto"><a><b>Deducciones:</b></a></legend>
                        <div class="row">
                            <div class="col-6 text-right">
                              <a>
                                <b>Refacción: $ </b>
                                <br />
                                <b>Servicio: $ </b>
                                <br />
                                <b>Impuestos: $ </b>
                                <br />
                              </a>
                            </div>
                            <div class="col-6 offset-6">
                              <a>
                                '.$SumRef[0].'
                                <br />
                                '.$SumSer[0].'
                                <br />
                                '.$total.'
                                <br />
                              </a>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-3 offset-9 text-center">
                    <fieldset class="border p-2" style="height: 2.5rem;">
                        <legend class="w-auto"><a><b>Total:</b></a></legend>
                        <div class="row">
                                <h3>$ '.$totalIva.'<br></h3>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="col-12 text-center" style="height: 7.5rem;">
                <h5>'.$totalEnLetra.'</h5>
            </div>   
                        <div class="row"  style="height: 6rem;">
                            <div class="col-4 text-center">
                                <a>Técnico<br>
                                _______________________<br>
                                '.$Orden['tec_taller'].'</a>
                            </div>
                            <div class="col-4 offset-4 text-center" >
                                <a>Mostrador<br>
                                _______________________<br>
                                '.$mostrador.'</a>
                            </div>
                            <div class="col-4 offset-8 text-center" >
                                <a>Cliente<br>
                                _______________________<br>
                                '.$recibe.'</a>
                            </div>
                        </div>
                <div class="col-12">
                  <a class="display-1">
                    Por favor conserve este comprobante ya que de lo contrario no se podrá hacer entrega de su producto; Le recordamos recoger su producto dentro de los 30 días naturales después de haber sido reparado, pasado 90 días naturales,
                    <b>Mayoreo Ferretero Atlas</b> no se hace responsable del producto. Cualquier revisión que no sea garantia, causará honorarios.
                    <br> 
                  </a>
                </div>
        </div>
    </body>
</html>
';

$html2 =  '
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
height: px;
border:1px dashed;
}
img {
  position: absolute; 
  z-index: 0; 
  opacity: 0.20; 
  filter: grayscale(1);
  margin-top: 7em;
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
.table .thead-dark th {
  color: #fff;
  background-color: #5a5c69;
  border-color: #6c6e7e;
}
    </style>
    <body>
        <img src="http://192.168.0.98/CentroServicio/assets/img/Logo/logo.png" />
        <div class="container-fluid">
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
            </div>
        </div>
            </div>
            <fieldset class="border p-2" style="height: 3.5rem;">
                <legend class="w-auto"><a><b>Datos del Cliente:</b></a></legend>
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
                <legend class="w-auto"><a><b>Datos del Servicio:</b></a></legend>
                <div class="row">
                    <div class="col-8">
                      <a>
                        <b>Servicio:</b>'.$Orden['tipo_servicio'].'
                        <br />
                        <b>Herramienta:</b>'.$Orden['desc_herramienta'].'
                        <br />
                        <b>Modelo:</b>'.$Orden['mod_herramienta'].'
                        <br />
                      </a>
                    </div>
                    <div class="col-4 offset-8">
                      <a>
                        <b>Fecha:</b>'.$Orden['fech_entrada'].'
                        <br />
                        <b>Marca:</b>'.$Orden['marca_herramienta'].'
                        <br />
                        <b>Serie:</b>'.$Orden['serie_herramienta'].'
                        <br />
                      </a>
                    </div>
                </div>
            </fieldset>
            <div class="row"  style="height: 13rem;">
                <div class="col-7">
                    <fieldset class="border p-2">
                        <legend class="w-auto"><b><a>Refacciones Utilizadas:</b></a></legend>
                        <table class="table table-borderless table-sm"  width="100%" cellspacing="0">
                            <tbody>
                            <tr>
                                <td><a>'.$itemRef[0]['cod_refaccion'].' '.$itemRef[0]['desc_refaccion'].'</a></td>
                                <td><a>'.$itemRef[0]['costo_refaccion'].'</a></td>
                            </tr>
                            <tr>
                                <td><a>'.$itemRef[1]['cod_refaccion'].' '.$itemRef[1]['desc_refaccion'].'</a></td>
                                <td><a>'.$itemRef[1]['costo_refaccion'].'</a></td>
                            </tr>
                            <tr>
                                <td><a>'.$itemRef[2]['cod_refaccion'].' '.$itemRef[2]['desc_refaccion'].'</a></td>
                                <td><a>'.$itemRef[2]['costo_refaccion'].'</a></td>
                            </tr>
                            <tr>
                                <td><a>'.$itemRef[3]['cod_refaccion'].' '.$itemRef[3]['desc_refaccion'].'</a></td>
                                <td><a>'.$itemRef[3]['costo_refaccion'].'</a></td>
                            </tr>
                            <tr>
                                <td><a>'.$itemRef[4]['cod_refaccion'].' '.$itemRef[4]['desc_refaccion'].'</a></td>
                                <td><a>'.$itemRef[4]['costo_refaccion'].'</a></td>
                            </tr>
                            <tr>
                              <td><a>'.$itemRef[5]['cod_refaccion'].' '.$itemRef[5]['desc_refaccion'].'</a></td>
                              <td><a>'.$itemRef[5]['costo_refaccion'].'</a></td>
                            </tr>
                            <tr>
                              <td><a>'.$itemRef[6]['cod_refaccion'].' '.$itemRef[6]['desc_refaccion'].'</a></td>
                              <td><a>'.$itemRef[6]['costo_refaccion'].'</a></td>
                            </tr>
                            <tr>
                              <td><a>'.$itemRef[7]['cod_refaccion'].' '.$itemRef[7]['desc_refaccion'].'</a></td>
                              <td><a>'.$itemRef[7]['costo_refaccion'].'</a></td>
                            </tr>
                            <tr>
                              <td><a>'.$itemRef[8]['cod_refaccion'].' '.$itemRef[8]['desc_refaccion'].'</a></td>
                              <td><a>'.$itemRef[8]['costo_refaccion'].'</a></td>
                            </tr>
                            <tr>
                              <td><a>'.$itemRef[9]['cod_refaccion'].' '.$itemRef[9]['desc_refaccion'].'</a></td>
                              <td><a>'.$itemRef[9]['costo_refaccion'].'</a></td>
                            </tr>
                                
                            </tbody>
                        </table>
                    </fieldset>
                </div>
                <div class="col-5 offset-7">
                    <fieldset class="border p-2">
                        <legend class="w-auto"><a><b>Servicios:</b></a></legend>
                        <table class="table table-borderless table-sm" width="100%" cellspacing="0">
                            
                            <tbody>
                                <tr>
                                    <td><a>'.$itemSer[0]['desc_servicio'].'</a></td>
                                    <td><a>'.$itemSer[0]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                    <td><a>'.$itemSer[1]['desc_servicio'].'</a></td>
                                    <td><a>'.$itemSer[1]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                    <td><a>'.$itemSer[2]['desc_servicio'].'</a></td>
                                    <td><a>'.$itemSer[2]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                    <td><a>'.$itemSer[3]['desc_servicio'].'</a></td>
                                    <td><a>'.$itemSer[3]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                    <td><a>'.$itemSer[4]['desc_servicio'].'</a></td>
                                    <td><a>'.$itemSer[4]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                  <td><a>'.$itemSer[4]['desc_servicio'].'</a></td>
                                  <td><a>'.$itemSer[4]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                  <td><a>'.$itemSer[5]['desc_servicio'].'</a></td>
                                  <td><a>'.$itemSer[5]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                  <td><a>'.$itemSer[6]['desc_servicio'].'</a></td>
                                  <td><a>'.$itemSer[6]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                  <td><a>'.$itemSer[7]['desc_servicio'].'</a></td>
                                  <td><a>'.$itemSer[7]['costo_servicio'].'</a></td>
                                </tr>
                                <tr>
                                  <td><a>'.$itemSer[8]['desc_servicio'].'</a></td>
                                  <td><a>'.$itemSer[8]['costo_servicio'].'</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
            <fieldset class="border p-2" style="height: 2.5rem;">
              <legend class="w-auto"><b><a>Observaciones del Servicio:</b></a></legend>
                <a>
                  '.$Orden['detalle_servicio'].'
                  <br />
                </a>
            </fieldset>
            <fieldset class="border p-2" style="height: 2.5rem;">
                <legend class="w-auto"><a><b>Complementarios:</b></a></legend>
                  <a>
                    '.$Orden['complementarios'].'
                    <br />
                  </a>
            </fieldset> 
            <div class="row"  style="height: 4.8rem;">
                <div class="col-5" >
                    <fieldset class="border p-2" style="height: 2.5rem;">
                      <legend class="w-auto"><a><b>Conceptos de pago:</b></a></legend>
                      <a>
                        <b>Tipo de pago:</b> '.$pago.'
                        <br>
                        <b>Forma de pago:</b> UNA EXHIBICIÓN
                        <br>
                        <b>Condiciones de pago:</b> '.$condicion.'
                        <br>
                      </a>
                    </fieldset>
                </div>
                <div class="col-4 offset-5">
                    <fieldset class="border p-2" style="height: 2.5rem;">
                        <legend class="w-auto"><a><b>Deducciones:</b></a></legend>
                        <div class="row">
                            <div class="col-6 text-right">
                              <a>
                                <b>Refacción: $ </b>
                                <br />
                                <b>Servicio: $ </b>
                                <br />
                                <b>Impuestos: $ </b>
                                <br />
                              </a>
                            </div>
                            <div class="col-6 offset-6">
                              <a>
                                '.$SumRef[0].'
                                <br />
                                '.$SumSer[0].'
                                <br />
                                '.$total.'
                                <br />
                              </a>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-3 offset-9 text-center">
                    <fieldset class="border p-2" style="height: 2.5rem;">
                        <legend class="w-auto"><a><b>Total:</b></a></legend>
                        <div class="row">
                                <h3>$ '.$totalIva.'<br></h3>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="col-12 text-center" style="height: 7.5rem;">
                <h5>'.$totalEnLetra.'</h5>
            </div>   
                        <div class="row"  style="height: 6rem;">
                            <div class="col-4 text-center">
                                <a>Técnico<br>
                                _______________________<br>
                                '.$Orden['tec_taller'].'</a>
                            </div>
                            <div class="col-4 offset-4 text-center" >
                                <a>Mostrador<br>
                                _______________________<br>
                                '.$mostrador.'</a>
                            </div>
                            <div class="col-4 offset-8 text-center" >
                                <a>Cliente<br>
                                _______________________<br>
                                '.$recibe.'</a>
                            </div>
                        </div>
                <div class="col-12">
                  <a class="display-1">
                    Por favor conserve este comprobante ya que de lo contrario no se podrá hacer entrega de su producto; Le recordamos recoger su producto dentro de los 30 días naturales después de haber sido reparado, pasado 90 días naturales,
                    <b>Mayoreo Ferretero Atlas</b> no se hace responsable del producto. Cualquier revisión que no sea garantia, causará honorarios.
                    <br> 
                  </a>
                </div>
        </div>


<p class="page-break"></p>


        <img src="http://192.168.0.98/CentroServicio/assets/img/Logo/logo.png" />
        <div class="container-fluid">
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
                <b>Garantia</b>
                <br>
              </h3>
            </div>
        </div>
            </div>
            <fieldset class="border p-2" style="height: 3.5rem;">
                <legend class="w-auto"><a><b>Datos del Cliente:</b></a></legend>
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
                <legend class="w-auto"><a><b>Datos del Servicio:</b></a></legend>
                <div class="row">
                    <div class="col-8">
                      <a>
                        <b>Servicio:</b>'.$Orden['tipo_servicio'].'
                        <br />
                        <b>Herramienta:</b>'.$Orden['desc_herramienta'].'
                        <br />
                        <b>Modelo:</b>'.$Orden['mod_herramienta'].'
                        <br />
                      </a>
                    </div>
                    <div class="col-4 offset-8">
                      <a>
                        <b>Fecha:</b>'.$Orden['fech_entrada'].'
                        <br />
                        <b>Marca:</b>'.$Orden['marca_herramienta'].'
                        <br />
                        <b>Serie:</b>'.$Orden['serie_herramienta'].'
                        <br />
                      </a>
                    </div>
                </div>
            </fieldset>
            <div class="row"  style="height: 14.2rem;">
                <div class="col-12">
                    <fieldset class="border p-2">
                        <legend class="w-auto"><b><a>Refacciones Utilizadas:</b></a></legend>
                        <table class="table table-borderless table-sm"  width="100%" cellspacing="0">
                            <thead class="thead-dark">
                              <tr>
                                  <th>Código Refacción</th>
                                  <th>Descripción</th>
                                  <th> </th>
                                  <th> </th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                  <td><a>'.$itemRef[0]['cod_refaccion'].'</a></td>
                                  <td><a>'.$itemRef[0]['desc_refaccion'].'</a></td>
                              </tr>
                              <tr>
                                  <td><a>'.$itemRef[1]['cod_refaccion'].'</a></td>
                                  <td><a>'.$itemRef[1]['desc_refaccion'].'</a></td>
                              </tr>
                              <tr>
                                  <td><a>'.$itemRef[2]['cod_refaccion'].'</a></td>
                                  <td><a>'.$itemRef[2]['desc_refaccion'].'</a></td>
                              </tr>
                              <tr>
                                  <td><a>'.$itemRef[3]['cod_refaccion'].'</a></td>
                                  <td><a>'.$itemRef[3]['desc_refaccion'].'</a></td>
                              </tr>
                              <tr>
                                  <td><a>'.$itemRef[4]['cod_refaccion'].'</a></td>
                                  <td><a>'.$itemRef[4]['desc_refaccion'].'</a></td>
                              </tr>
                              <tr>
                                <td><a>'.$itemRef[5]['cod_refaccion'].'</a></td>
                                <td><a>'.$itemRef[5]['desc_refaccion'].'</a></td>
                              </tr>
                              <tr>
                                <td><a>'.$itemRef[6]['cod_refaccion'].'</a></td>
                                <td><a>'.$itemRef[6]['desc_refaccion'].'</a></td>
                              </tr>
                              <tr>
                                <td><a>'.$itemRef[7]['cod_refaccion'].'</a></td>
                                <td><a>'.$itemRef[7]['desc_refaccion'].'</a></td>
                              </tr>
                              <tr>
                                <td><a>'.$itemRef[8]['cod_refaccion'].'</a></td>
                                <td><a>'.$itemRef[8]['desc_refaccion'].'</a></td>
                              </tr>
                              <tr>
                                <td><a>'.$itemRef[9]['cod_refaccion'].'</a></td>
                                <td><a>'.$itemRef[9]['desc_refaccion'].'</a></td>
                              </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
            <div class="row"  style="height: 15.5rem;">
                <div class="col-12 text-center">
                    <fieldset class="border p-2" style="height: 12rem;">
                        <legend class="w-auto"><a><b>Notas:</b></a></legend>
                        <div class="row">
                          <br>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="col-12 text-center" style="height: 7.5rem;">
                <h5>'.$totalEnLetra.'</h5>
            </div>   
                        <div class="row"  style="height: 6rem;">
                            <div class="col-4 text-center">
                                <a>Técnico<br>
                                _______________________<br>
                                '.$Orden['tec_taller'].'</a>
                            </div>
                            <div class="col-4 offset-4 text-center" >
                                <a>Mostrador<br>
                                _______________________<br>
                                '.$mostrador.'</a>
                            </div>
                            <div class="col-4 offset-8 text-center" >
                                <a>Cliente<br>
                                _______________________<br>
                                '.$recibe.'</a>
                            </div>
                        </div>
                <div class="col-12">
                  <a class="display-1">
                    Por favor conserve este comprobante ya que de lo contrario no se podrá hacer entrega de su producto; Le recordamos recoger su producto dentro de los 30 días naturales después de haber sido reparado, pasado 90 días naturales,
                    <b>Mayoreo Ferretero Atlas</b> no se hace responsable del producto. Cualquier revisión que no sea garantia, causará honorarios.
                    <br> 
                  </a>
                </div>
        </div>
    </body>
</html>
';

// instantiate and use the dompdf class
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$dompdf = new Dompdf($options);
if ($Orden['tipo_servicio']=="Garantia" ||$Orden['tipo_servicio']=="Mantenimiento/Garantía" ) {
  $dompdf->loadHtml($html2);
}else {
  $dompdf->loadHtml($html);
}


// (Optional) Setup the paper size and orientation
$dompdf->setPaper('Letter', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$output = $dompdf->output(); 

$dompdf->stream('document.pdf',array('Attachment'=>0));

if ($correoOn=="on") {
//Parametros del correo
$remitente="Centro de Servicio MFA";
$destinatario=$recibe;
$titulo="Orden folio: ".$folio;
$body = '
<body style="margin: 0; padding: 0;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
<tr>
<td align="center" bgcolor="#f44336" style="padding: 10px 0 10px 0; color: #ffffff; font-family: Arial, sans-serif; font-size: 38px; line-height: 32px;">
<img src="cid:fma" width="150" height="150" style="display: block;" />
<img src="cid:txt" width="300" style="display: block;" />
</td>
</tr>
<tr>
<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td>
Estimado/a '.$destinatario .':
<br>Se envió una copia de la  orden con el folio '.$folio.'
<br>&nbsp;
<br>Si tiene dudas, póngase en contacto con el Centro de Servicio.
<br> &nbsp;
<br> <b>Mayoreo Ferretero Atlas</b> le agradece su preferencia.
<br> &nbsp;
</td>
</tr>
<tr>
<td align="center"
style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
<b>Matriz Centro de Servicio</b>
</td>
</tr>
<tr>
<td style="padding: 20px 0 30px 0;"
style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
Guadalupe Victoria #55<br>
Tel: 33450116 ext 134/124<br>
csa@mayoreoferreteroatlas.com<br>
Lunes a Viernes: 08:30am - 06:00pm<br>
Sábados: 08:30am - 02:00pm
</td>
</tr>
<tr>
<td>
&nbsp;
</td>
</tr>
<tr>
<td style="padding: 10px 0 10px 0;"
style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
<b>A T E N T A M E N T E</b><br>
<a href="https://mayoreoferreteroatlas.com/mfatlas/" >
Mayoreo Ferretero Atlas
</a>
<br> &nbsp;
<br> No responda a este correo electrónico. 
<br>Para comunicarse con nosotros utilice nuestras redes sociales o comuníquese con las sucursales de <b>Mayoreo Ferretero Atlas</b>.
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td bgcolor="#dddfeb" style="padding: 30px 30px 30px 30px;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td width="60%"
style="color: #858796; font-family: Arial, sans-serif; font-size: 14px;">
&reg; MFA, Centro de Servicio '.date('Y').'
</td>
<td align="right">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td>
<a href="https://twitter.com/SISTEATLAS?lang=es">
<img src="cid:tw" alt="Twitter" width="38" height="38"
style="display: block;" border="0" />
</a>
</td>
<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
<td>
<a href="https://www.facebook.com/mayoreoferreatlasgdl/">
<img src="cid:fb" alt="Facebook" width="38" height="38"
style="display: block;" border="0" />
</a>
</td>
<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
<td>
<a href="https://www.youtube.com/channel/UCvOGiYvRYUUTkRZC35t28Qg">
<img src="cid:yt" alt="YouTube" width="38" height="38"
style="display: block;" border="0" />
</a>
</td>
<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
<td>
<a href="https://api.whatsapp.com/send?phone=523315731134&fbclid=IwAR0YsC6-ff7ymrT2dyP3KaFyzSDecIoL_6SAivv3ULqBFsmhAMFF6grgcpA">
<img src="cid:wp" alt="Whatsapp" width="38" height="38"
style="display: block;" border="0" />
</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
';
$filename = 'Orden'.$folio.'.pdf';
        $encoding = 'base64';
        $type = 'application/pdf';

//Crear una instancia de PHPMailer
$mail = new PHPMailer();
//Definir que vamos a usar SMTP
$mail->IsSMTP();
//Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
// 0 = off (producción)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug  = 0;
//Ahora definimos gmail como servidor que aloja nuestro SMTP
$mail->Host       = 'smtp.gmail.com';
//El puerto será el 587 ya que usamos encriptación TLS
$mail->Port       = 587;
//Definmos la seguridad como TLS
$mail->SMTPSecure = 'tls';
//Tenemos que usar gmail autenticados, así que esto a TRUE
$mail->SMTPAuth   = true;
//Definimos la cuenta que vamos a usar. Dirección completa de la misma
$mail->Username   = "csa.mayoreoferreteroatlas@gmail.com";
//Introducimos nuestra contraseña de gmail
$mail->Password   = "M@y0r30F3rr3t3r0";
//Definimos el remitente (dirección y, opcionalmente, nombre)
$mail->SetFrom('csa@mayoreoferreteroatlas.com', $remitente);
//Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
$mail->AddAddress($clienteMail, $destinatario);
//Definimos el tema del email
$mail->Subject = $titulo;
//Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
$mail->Body = $body;
//Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
$mail->AltBody = $body;
$mail->CharSet = 'UTF-8';
// Attachments
$mail->addEmbeddedImage(dirname(__FILE__).'/img/logo.png','fma');
$mail->addEmbeddedImage(dirname(__FILE__).'/img/logo-mfa.png','txt');
$mail->addEmbeddedImage(dirname(__FILE__).'/img/fb.png','fb');
$mail->addEmbeddedImage(dirname(__FILE__).'/img/tw.png','tw');
$mail->addEmbeddedImage(dirname(__FILE__).'/img/yt.png','yt');
$mail->addEmbeddedImage(dirname(__FILE__).'/img/wp.png','wp');
$mail->AddStringAttachment($output,$filename,$encoding,$type);
//Enviamos el correo
$mail->Send();
 
}

?>