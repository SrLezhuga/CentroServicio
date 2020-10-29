<?php 
require_once '../../vendor/dompdf/autoload.inc.php';
include("../conexion.php");
$reporte=1;
$recibe="Nombre Apellido";
$mostrador="Mostrador";

$queryOrden = "SELECT * FROM tab_orden WHERE id_orden =".$reporte; 
$rsOrden = mysqli_query($con, $queryOrden) or die ("Error de consulta"); 
$Orden = mysqli_fetch_array($rsOrden);
    
    $folio=$Orden[id_orden];
    if(strlen($folio)==1){
        $folio="0000".$folio;
    }else if(strlen($folio)==2){
        $folio="000".$folio;
    }else if(strlen($folio)==3){
        $folio="00".$folio;
    }else if(strlen($folio)==4){
        $folio="0".$folio;
    }

$queryCliente = "SELECT * FROM tab_cliente WHERE id_cliente = ".$Orden[id_cliente]; 
$rsCliente = mysqli_query($con, $queryCliente) or die ("Error de consulta"); 
$Cliente = mysqli_fetch_array($rsCliente);

$queryRefaccion = "SELECT * FROM tab_ordenrefaccion WHERE id_orden = ".$reporte; 
$rsRefaccion = mysqli_query($con, $queryRefaccion) or die ("Error de consulta"); 

for ($i=0; $i < 10 ; $i++) { 
    $itemRef[$i] = [ 'cod_refaccion' => '&nbsp;', 'desc_refaccion' => '&nbsp;', 'marca_refaccion' => '&nbsp;', 'costo_refaccion' => '&nbsp;' ];
}
$i=0;
while($Refaccion = mysqli_fetch_array($rsRefaccion)){
    
    $itemRef[$i][cod_refaccion]=$Refaccion[cod_refaccion];
    $itemRef[$i][desc_refaccion]=$Refaccion[desc_refaccion];
    $itemRef[$i][marca_refaccion]=$Refaccion[marca_refaccion];
    $itemRef[$i][costo_refaccion]=$Refaccion[costo_refaccion];
    $i++;
}

$queryServicio = "SELECT * FROM tab_ordenservicio WHERE id_orden = ".$reporte; 
$rsServicio = mysqli_query($con, $queryServicio) or die ("Error de consulta"); 

for ($i=0; $i < 10 ; $i++) { 
    $itemSer[$i] = [ 'cod_servicio' => '&nbsp;', 'desc_servicio' => '&nbsp;', 'costo_servicio' => '&nbsp;' ];
}
$i=0;
while($Servicio = mysqli_fetch_array($rsServicio)){
    
    $itemSer[$i][cod_servicio]=$Servicio[cod_servicio];
    $itemSer[$i][desc_servicio]=$Servicio[desc_servicio];
    $itemSer[$i][costo_servicio]=$Servicio[costo_servicio];
    $i++;
}

$querySumRef = "SELECT SUM(costo_refaccion) FROM tab_ordenrefaccion WHERE id_orden = ".$reporte; 
$rsSumRef = mysqli_query($con, $querySumRef) or die ("Error de consulta"); 
$SumRef = mysqli_fetch_array($rsSumRef);

$querySumSer = "SELECT SUM(costo_servicio) FROM tab_ordenservicio WHERE id_orden = ".$reporte; 
$rsSumSer = mysqli_query($con, $querySumSer) or die ("Error de consulta"); 
$SumSer = mysqli_fetch_array($rsSumSer);

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <img class="img-fluid mx-auto d-block" src="logo.png" style="position: absolute; z-index: 0; opacity: 0.15; filter: grayscale(1);" />
        <div class="container-fluid">
            <h1 class="display-4 text-center"><strong>Centro de servicio</strong></h1>
            <hr />

            <fieldset class="border p-2">
                <div class="row">
                    <div class="col-6">
                        <h4>
                            Mayoreo Ferretero Atlas SA de CV<br />
                            Guadalupe Victoria #31<br />
                            Tel: 33450116 ext 134/124 <br />
                            csa@mayoreoferreteroatlas.com
                        </h4>
                    </div>
                    <div class="col-6 text-right">
                        <h4 class="folio"><strong>FOLIO:'.$folio.'</strong></h4>
                        <h4>26 de Septiembre del 2020</h4>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2">
                <legend class="w-auto">Datos del Cliente:</legend>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label><b>Nombre:</b></label>
                        <a>'.$Cliente[nom_cliente].'</a>
                        <br />
                        <label><b>Domicilio:</b></label>
                        <a>'.$Cliente[dir_cliente].'</a>
                        <br />
                        <label><b>Municipio:</b></label>
                        <a>'.$Cliente[mun_cliente].'</a>
                        <br />
                        <label><b>Teléfono:</b></label>
                        <a>'.$Cliente[tel_cliente].'</a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label><b>RFC:</b></label>
                        <a>'.$Cliente[rfc_cliente].'</a>
                        <br />
                        <label><b>C.P:</b></label>
                        <a>'.$Cliente[cp_cliente].'</a>
                        <br />
                        <label><b>Correo:</b></label>
                        <a>'.$Cliente[mail_cliente].'</a>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2">
                <legend class="w-auto">Datos del Servicio:</legend>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label><b>Servicio:</b></label>
                        <a>'.$Orden[tipo_servicio].'</a>
                        <br />
                        <label><b>Herramienta:</b></label>
                        <a>'.$Orden[desc_herramienta].'</a>
                        <br />
                        <label><b>Modelo:</b></label>
                        <a>'.$Orden[mod_herramienta].'</a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label><b>Fecha:</b></label>
                        <a>'.$Orden[fech_entrada].'</a>
                        <br />
                        <label><b>Marca:</b></label>
                        <a>'.$Orden[marca_herramienta].'</a>
                        <br />
                        <label><b>Adicional:</b></label>
                        <a>'.$Orden[tipo_herramienta].'</a>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2">
                <legend class="w-auto">Refacciones Utilizadas:</legend>
                <table class="table table-borderless table-sm" id="dataTableCliente" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Marca</th>
                            <th>Costo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>'.$itemRef[0][cod_refaccion].'</td>
                            <td>'.$itemRef[0][desc_refaccion].'</td>
                            <td>'.$itemRef[0][marca_refaccion].'</td>
                            <td>'.$itemRef[0][costo_refaccion].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemRef[1][cod_refaccion].'</td>
                            <td>'.$itemRef[1][desc_refaccion].'</td>
                            <td>'.$itemRef[1][marca_refaccion].'</td>
                            <td>'.$itemRef[1][costo_refaccion].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemRef[2][cod_refaccion].'</td>
                            <td>'.$itemRef[2][desc_refaccion].'</td>
                            <td>'.$itemRef[2][marca_refaccion].'</td>
                            <td>'.$itemRef[2][costo_refaccion].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemRef[3][cod_refaccion].'</td>
                            <td>'.$itemRef[3][desc_refaccion].'</td>
                            <td>'.$itemRef[3][marca_refaccion].'</td>
                            <td>'.$itemRef[3][costo_refaccion].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemRef[4][cod_refaccion].'</td>
                            <td>'.$itemRef[4][desc_refaccion].'</td>
                            <td>'.$itemRef[4][marca_refaccion].'</td>
                            <td>'.$itemRef[4][costo_refaccion].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemRef[5][cod_refaccion].'</td>
                            <td>'.$itemRef[5][desc_refaccion].'</td>
                            <td>'.$itemRef[5][marca_refaccion].'</td>
                            <td>'.$itemRef[5][costo_refaccion].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemRef[6][cod_refaccion].'</td>
                            <td>'.$itemRef[6][desc_refaccion].'</td>
                            <td>'.$itemRef[6][marca_refaccion].'</td>
                            <td>'.$itemRef[6][costo_refaccion].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemRef[7][cod_refaccion].'</td>
                            <td>'.$itemRef[7][desc_refaccion].'</td>
                            <td>'.$itemRef[7][marca_refaccion].'</td>
                            <td>'.$itemRef[7][costo_refaccion].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemRef[8][cod_refaccion].'</td>
                            <td>'.$itemRef[8][desc_refaccion].'</td>
                            <td>'.$itemRef[8][marca_refaccion].'</td>
                            <td>'.$itemRef[8][costo_refaccion].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemRef[9][cod_refaccion].'</td>
                            <td>'.$itemRef[9][desc_refaccion].'</td>
                            <td>'.$itemRef[9][marca_refaccion].'</td>
                            <td>'.$itemRef[9][costo_refaccion].'</td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
            <fieldset class="border p-2">
                <legend class="w-auto">Servicios:</legend>
                <table class="table table-borderless table-sm" id="dataTableCliente" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Costo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>'.$itemSer[0][cod_servicio].'</td>
                            <td>'.$itemSer[0][desc_servicio].'</td>
                            <td>'.$itemSer[0][costo_servicio].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemSer[1][cod_servicio].'</td>
                            <td>'.$itemSer[1][desc_servicio].'</td>
                            <td>'.$itemSer[1][costo_servicio].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemSer[2][cod_servicio].'</td>
                            <td>'.$itemSer[2][desc_servicio].'</td>
                            <td>'.$itemSer[2][costo_servicio].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemSer[3][cod_servicio].'</td>
                            <td>'.$itemSer[3][desc_servicio].'</td>
                            <td>'.$itemSer[3][costo_servicio].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemSer[4][cod_servicio].'</td>
                            <td>'.$itemSer[4][desc_servicio].'</td>
                            <td>'.$itemSer[4][costo_servicio].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemSer[5][cod_servicio].'</td>
                            <td>'.$itemSer[5][desc_servicio].'</td>
                            <td>'.$itemSer[5][costo_servicio].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemSer[6][cod_servicio].'</td>
                            <td>'.$itemSer[6][desc_servicio].'</td>
                            <td>'.$itemSer[6][costo_servicio].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemSer[7][cod_servicio].'</td>
                            <td>'.$itemSer[7][desc_servicio].'</td>
                            <td>'.$itemSer[7][costo_servicio].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemSer[8][cod_servicio].'</td>
                            <td>'.$itemSer[8][desc_servicio].'</td>
                            <td>'.$itemSer[8][costo_servicio].'</td>
                        </tr>
                        <tr>
                            <td>'.$itemSer[9][cod_servicio].'</td>
                            <td>'.$itemSer[9][desc_servicio].'</td>
                            <td>'.$itemSer[9][costo_servicio].'</td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
            <div class="row">
                <div class="col-8" >
                    <fieldset class="border p-2" style="height: 11rem;">
                        <legend class="w-auto">Observaciones del Servicio:</legend>
                        <a>'.$Orden[detalle_servicio].'</a>
                    </fieldset>
                </div>
                <div class="col-4">
                    <fieldset class="border p-2">
                        <legend class="w-auto">Deducciones:</legend>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                                <a><b>Refacciones: $</b></a>
                                <br />
                                <a><b>Servicios: $</b></a>
                                <br />
                                <a><b>Impuestos: $</b></a>
                                <br />
                                <h3><b>Total: $</b></h3>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <a>'.$SumRef[0].'.00</a>
                                <br />
                                <a>'.$SumSer[0].'.00</a>
                                <br />
                                <a>'.(($SumRef[0]+$SumSer[0])*.16).'</a>
                                <br />
                                <h3>'.(($SumRef[0]+$SumSer[0])*1.16).'</h3>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="row text-center">
                <div class="col">
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>Técnico<br>
                    ______________________________<br>
                    '.$Orden[tec_taller].'</p>
                </div>
                <div class="col">
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>Mostrador<br>
                    ______________________________<br>
                    '.$mostrador.'</p>
                </div>
                <div class="col">
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>Cliente<br>
                    ______________________________<br>
                    '.$recibe.'</p>
                </div>
            </div>
            <br>
            <hr>
            <h1 class="display-4 text-center"><strong>Centro de servicio</strong></h1>
            <fieldset class="border p-2">
                <legend class="w-auto">Talonario para el cliente:</legend>
                    <div class="row">
                        <div class="col-4">
                            <p>Recibido por:</p>
                            <p>'.$recibe.'</p>
                        </div>
                        <div class="col-4">
                            <p>Atendido por:</p>
                            <p>'.$mostrador.'</p>
                        </div>
                        <div class="col-4 text-right">
                            <h4 class="folio"><strong>FOLIO:'.$folio.'</strong></h4>
                            <h4>26 de Septiembre del 2020</h4>
                        </div>
                    </div>
             </fieldset>
             <p>
             Por favor conserve este comprobante ya que de lo contrario no se podrá hacer entrega de su producto; Le recordamos
             recoger su producto dentro de los 30 días naturales después de haber sido reparado, pasado 90 días naturales,
             Mayoreo Ferretero Atlas no se hace responsable del producto. Cualquier revision que no sea garantia, causara
             honorarios.
             </p>
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