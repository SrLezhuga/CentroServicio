<?php 
require_once '../../vendor/dompdf/autoload.inc.php';
include("../conexion.php");
require_once "traslate.php";
session_start();

$reporte=$_POST['reporte'];
$mostrador=$_SESSION['name_user'];



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

    
$fecha=$Orden['fech_salida'];

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
$rsCliente = mysqli_query($con, $queryCliente) or die ("Error de consulta"); 
$Cliente = mysqli_fetch_array($rsCliente);

$queryRefaccion = "SELECT * FROM tab_ordenrefaccion WHERE id_orden = ".$reporte; 
$rsRefaccion = mysqli_query($con, $queryRefaccion) or die ("Error de consulta"); 

for ($i=0; $i < 10 ; $i++) { 
    $itemRef[$i] = [ 'cod_refaccion' => '&nbsp;', 'desc_refaccion' => '&nbsp;', 'marca_refaccion' => '&nbsp;', 'costo_refaccion' => '&nbsp;' ];
}
$i=0;
while($Refaccion = mysqli_fetch_array($rsRefaccion)){
    
    $itemRef[$i]['cod_refaccion']=$Refaccion['cod_refaccion'];
    $itemRef[$i]['desc_refaccion']=$Refaccion['desc_refaccion'];
    $itemRef[$i]['marca_refaccion']=$Refaccion['marca_refaccion'];
    $itemRef[$i]['costo_refaccion']=$Refaccion['costo_refaccion'];
    $i++;
}

$queryServicio = "SELECT * FROM tab_ordenservicio WHERE id_orden = ".$reporte; 
$rsServicio = mysqli_query($con, $queryServicio) or die ("Error de consulta"); 

for ($i=0; $i < 10 ; $i++) { 
    $itemSer[$i] = [ 'cod_servicio' => '&nbsp;', 'desc_servicio' => '&nbsp;', 'costo_servicio' => '&nbsp;' ];
}
$i=0;
while($Servicio = mysqli_fetch_array($rsServicio)){
    
    $itemSer[$i]['cod_servicio']=$Servicio['cod_servicio'];
    $itemSer[$i]['desc_servicio']=$Servicio['desc_servicio'];
    $itemSer[$i]['costo_servicio']=$Servicio['costo_servicio'];
    $i++;
}

$querySumRef = "SELECT SUM(costo_refaccion) FROM tab_ordenrefaccion WHERE id_orden = ".$reporte; 
$rsSumRef = mysqli_query($con, $querySumRef) or die ("Error de consulta"); 
$SumRef = mysqli_fetch_array($rsSumRef);

$querySumSer = "SELECT SUM(costo_servicio) FROM tab_ordenservicio WHERE id_orden = ".$reporte; 
$rsSumSer = mysqli_query($con, $querySumSer) or die ("Error de consulta"); 
$SumSer = mysqli_fetch_array($rsSumSer);



if ($Orden['iva_orden']=="Si") {
  $total=(($SumRef[0]+$SumSer[0])*.16);
  $totalIva=(($SumRef[0]+$SumSer[0])*1.16);
  $iva="Si";
}else{
  $total=0;
  $totalIva=($SumRef[0]+$SumSer[0]);
  $iva="No";
}

$totalEnLetra=convertir($totalIva);

$html =  '<html>
  <head>
    <title> Centro de Servicio MFA | Reporte</title>
    <link rel="icon" href="http://localhost/CentroServicio/assets/img/Logo/MFA.ico" />
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
    </style>
    <body>
        <img src="http://localhost/CentroServicio/assets/img/Logo/logo.png" />
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
            <div class="row" style="height: 5.5rem;">
              <div class="col-12">
                <a><strong>Mayoreo Ferretero Atlas SA de CV</strong><br />
                <b>RFC MFA030403T73</b><br />
                Guadalupe Victoria #31<br />
                Tel: 33450116 ext 134/124 
                </a>
              </div>
            </div>
            <fieldset class="border p-2" style="height: 4.2rem;">
                <legend class="w-auto"><strong>Datos del Cliente:</strong></legend>
                <div class="row">
                    <div class="col-6">
                        <label><b>Nombre:</b></label>
                        <a>'.$Cliente['nom_cliente'].'</a>
                        <br />
                        <label><b>Domicilio:</b></label>
                        <a>'.$Cliente['dir_cliente'].'</a>
                        <br />
                        <label><b>Municipio:</b></label>
                        <a>'.$Cliente['mun_cliente'].'</a>
                        <br />
                        <label><b>Teléfono:</b></label>
                        <a>'.$Cliente['tel_cliente'].'</a>
                    </div>
                    <div class="col-6 offset-6">
                        <label><b>RFC:</b></label>
                        <a>'.$Cliente['rfc_cliente'].'</a>
                        <br />
                        <label><b>C.P:</b></label>
                        <a>'.$Cliente['cp_cliente'].'</a>
                        <br />
                        <label><b>Correo:</b></label>
                        <a>'.$Cliente['mail_cliente'].'</a>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2" style="height: 3.2rem;">
                <legend class="w-auto"><strong>Datos del Servicio:</strong></legend>
                <div class="row">
                    <div class="col-8">
                        <label><b>Servicio:</b></label>
                        <a>'.$Orden['tipo_servicio'].'</a>
                        <br />
                        <label><b>Herramienta:</b></label>
                        <a>'.$Orden['desc_herramienta'].'</a>
                        <br />
                        <label><b>Modelo:</b></label>
                        <a>'.$Orden['mod_herramienta'].'</a>
                    </div>
                    <div class="col-4 offset-8">
                        <label><b>Fecha:</b></label>
                        <a>'.$Orden['fech_entrada'].'</a>
                        <br />
                        <label><b>Marca:</b></label>
                        <a>'.$Orden['marca_herramienta'].'</a>
                        <br />
                        <label><b>Adicional:</b></label>
                        <a>'.$Orden['tipo_herramienta'].'</a>
                    </div>
                </div>
            </fieldset>
            <div class="row"  style="height: 15.5rem;">
                <div class="col-7">
                    <fieldset class="border p-2">
                        <legend class="w-auto"><strong>Refacciones Utilizadas:</strong></legend>
                        <table class="table table-borderless table-sm"  width="100%" cellspacing="0">
                            
                            <tbody>
                                <tr>
                                    <td>'.$itemRef[0]['desc_refaccion'].'</td>
                                    <td>'.$itemRef[0]['costo_refaccion'].'</td>
                                </tr>
                                <tr>
                                    <td>'.$itemRef[1]['desc_refaccion'].'</td>
                                    <td>'.$itemRef[1]['costo_refaccion'].'</td>
                                </tr>
                                <tr>
                                    <td>'.$itemRef[2]['desc_refaccion'].'</td>
                                    <td>'.$itemRef[2]['costo_refaccion'].'</td>
                                </tr>
                                <tr>
                                    <td>'.$itemRef[3]['desc_refaccion'].'</td>
                                    <td>'.$itemRef[3]['costo_refaccion'].'</td>
                                </tr>
                                <tr>
                                    <td>'.$itemRef[4]['desc_refaccion'].'</td>
                                    <td>'.$itemRef[4]['costo_refaccion'].'</td>
                                </tr>
                                <tr>
                                  <td>'.$itemRef[5]['desc_refaccion'].'</td>
                                  <td>'.$itemRef[5]['costo_refaccion'].'</td>
                                </tr>
                                <tr>
                                  <td>'.$itemRef[6]['desc_refaccion'].'</td>
                                  <td>'.$itemRef[6]['costo_refaccion'].'</td>
                                </tr>
                                <tr>
                                  <td>'.$itemRef[7]['desc_refaccion'].'</td>
                                  <td>'.$itemRef[7]['costo_refaccion'].'</td>
                                </tr>
                                <tr>
                                  <td>'.$itemRef[8]['desc_refaccion'].'</td>
                                  <td>'.$itemRef[8]['costo_refaccion'].'</td>
                                </tr>
                                <tr>
                                  <td>'.$itemRef[9]['desc_refaccion'].'</td>
                                  <td>'.$itemRef[9]['costo_refaccion'].'</td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
                <div class="col-5 offset-7">
                    <fieldset class="border p-2">
                        <legend class="w-auto"><strong>Servicios:</strong></legend>
                        <table class="table table-borderless table-sm" width="100%" cellspacing="0">
                            
                            <tbody>
                                <tr>
                                    <td>'.$itemSer[0]['desc_servicio'].'</td>
                                    <td>'.$itemSer[0]['costo_servicio'].'</td>
                                </tr>
                                <tr>
                                    <td>'.$itemSer[1]['desc_servicio'].'</td>
                                    <td>'.$itemSer[1]['costo_servicio'].'</td>
                                </tr>
                                <tr>
                                    <td>'.$itemSer[2]['desc_servicio'].'</td>
                                    <td>'.$itemSer[2]['costo_servicio'].'</td>
                                </tr>
                                <tr>
                                    <td>'.$itemSer[3]['desc_servicio'].'</td>
                                    <td>'.$itemSer[3]['costo_servicio'].'</td>
                                </tr>
                                <tr>
                                    <td>'.$itemSer[4]['desc_servicio'].'</td>
                                    <td>'.$itemSer[4]['costo_servicio'].'</td>
                                </tr>
                                <tr>
                                  <td>'.$itemSer[4]['desc_servicio'].'</td>
                                  <td>'.$itemSer[4]['costo_servicio'].'</td>
                                </tr>
                                <tr>
                                  <td>'.$itemSer[5]['desc_servicio'].'</td>
                                  <td>'.$itemSer[5]['costo_servicio'].'</td>
                                </tr>
                                <tr>
                                  <td>'.$itemSer[6]['desc_servicio'].'</td>
                                  <td>'.$itemSer[6]['costo_servicio'].'</td>
                                </tr>
                                <tr>
                                  <td>'.$itemSer[7]['desc_servicio'].'</td>
                                  <td>'.$itemSer[7]['costo_servicio'].'</td>
                                </tr>
                                <tr>
                                  <td>'.$itemSer[8]['desc_servicio'].'</td>
                                  <td>'.$itemSer[8]['costo_servicio'].'</td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
            <fieldset class="border p-2" style="height: 3.5rem;">
              <legend class="w-auto"><strong>Observaciones del Servicio:</strong></legend>
              <a>'.$Orden['detalle_servicio'].'</a>
            </fieldset>
            <div class="row"  style="height: 4.8rem;">
                <div class="col-5" >
                    <fieldset class="border p-2" style="height: 3.2rem;">
                        <legend class="w-auto"><strong>Conseptos de pago:</strong></legend>
                       <a><b>Tipo de pago:</b> '.$Orden['pago_orden'].'</a><br>
                       <a><b>Forma de pago:</b> UNA EXHIBICIÓN</a><br>
                       <a><b>Condiciones de pago:</b> CONTADO</a><br>
                    </fieldset>
                </div>
                <div class="col-4 offset-5">
                    <fieldset class="border p-2" style="height: 3.2rem;">
                        <legend class="w-auto"><strong>Deducciones:</strong></legend>
                        <div class="row">
                            <div class="col-6 text-right">
                                <a><b>Refaccion: $ </b><br />
                                <b>Servicio: $ </b><br />
                                <b>Impuestos: $ </b></a><br />
                            </div>
                            <div class="col-6 offset-6">
                                <a>'.$SumRef[0].'.00<br />
                                '.$SumSer[0].'.00<br />
                                '.$total.'<br />
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-3 offset-9 text-center">
                    <fieldset class="border p-2" style="height: 3.2rem;">
                        <legend class="w-auto"><strong>Total:</strong></legend>
                        <div class="row">
                                <h3>$ '.$totalIva.'</h3>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="col-12 text-center" style="height: 7.5rem;">
                <h5>'.$totalEnLetra.'</h5>
            </div>   
                        <div class="row"  style="height: 6rem;">
                            <div class="col-4 text-center">
                                <p>Técnico<br>
                                _______________________<br>
                                '.$Orden['tec_taller'].'</p>
                            </div>
                            <div class="col-4 offset-4 text-center" >
                                <p>Mostrador<br>
                                _______________________<br>
                                '.$mostrador.'</p>
                            </div>
                            <div class="col-4 offset-8 text-center" >
                                <p>Cliente<br>
                                _______________________<br>
                                '.$Cliente['nom_cliente'].'</p>
                            </div>
                        </div>
                <div class="col-12">
                  <a class="display-1">
                    Por favor conserve este comprobante ya que de lo contrario no se podrá hacer entrega de su producto; Le recordamos
                    recoger su producto dentro de los 30 días naturales después de haber sido reparado, pasado 90 días naturales,
                    Mayoreo Ferretero Atlas no se hace responsable del producto. Cualquier revision que no sea garantia, causara
                    honorarios.
                   </a>
                </div>
        </div>
    </body>
</html>
';

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

// instantiate and use the dompdf class
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('Letter', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// add the header

$canvas = $dompdf->get_canvas();
$footer = $canvas->open_object();

    $canvas->page_text(500, 760, "Reimpresión folio",
    "helvetica", 10, array(0,0,0));

$canvas->close_object();
$canvas->add_object($footer, "all");

// Output the generated PDF to Browser

$dompdf->stream('document.pdf',array('Attachment'=>0));

?>