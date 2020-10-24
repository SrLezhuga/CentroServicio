<?php
header('Content-Type: text/html; charset=UTF-8');
require_once('tcpdf_include.php');
require_once('../../conexion/conec.php');
	session_start();
	$db=new Conexion();
    $db->set_charset("utf8");
    $id=$_GET['id'];
    $consu="SELECT tab_refacciones.tab_orden_reparo_folio, tab_refacciones.modelo,  tab_refacciones.descripcion, tab_refacciones.cantidad  FROM tab_refacciones INNER JOIN tab_orden_reparo on tab_orden_reparo.folio = '$id' where tab_refacciones.tab_orden_reparo_folio= tab_orden_reparo.folio";
    
    $repor2=$db->query($consu);
      
	
    $repor="SELECT * FROM tab_orden_reparo where  folio= '$id'";
    $repor1=$db->query($repor);
    $tres=$repor1->fetch_array();

     $status_oc="SELECT * FROM `bitacora_oc` WHERE folio='$id' ORDER BY fecha DESC ";
    mysqli_query("SET NAMES 'utf8'");
    $status_oc1=$db->query($status_oc);
    $tres1=$status_oc1->fetch_array();
     
     $resul="SELECT sum(costo_real) as total FROM `tab_orden_reparo` WHERE folio='$id'";
     
     $res=$db->query($resul);
     $total=$res->fetch_array($res);
	 
	 $final=$tres['importe']+$total['total']+$IVA;


class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		
		$image_file = K_PATH_IMAGES.'ferretero.PNG';
		$this->Image($image_file, 15, 5, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B',10);
		// Title
		$this->Cell(0, 20, 'MAYOREO FERRETERO ATLAS SA DE CV', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(5);
		$this->SetFont('helvetica', 'B',7);
		$this->Cell(0, 15, '                                      CENTRO DE SERVICIO AUTORIZADO', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(5);
		$this->Cell(0, 15, '                                        RFC MFA030403T73, CALZADA INDEPENDENCIA SUR #31', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(5);
		$this->Cell(0, 15, '                               Tel: 33450116 ext 134/124 ---- csa@mayoreoferreteroatlas.com '. $fecha, 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(5);
		
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
Ob_end_clean();
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UTF-8', FALSE);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Reporte');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// set default header data
$pdf->SetHeaderData(TRUE);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}



// Add a page 
// This method has several options, check the source code documentation for more information.
$pdf->startPageGroup();

$pdf->AddPage('H', 'A4');
// SACAR EL PROYECTO,PROGRAMA, OBJETIVO

//$pdf->setEqualColumns(3, 35);

$pdf->SetFont('helvetica', 'I', 10);


// sacar folio y importe de los ticket activos

$html ='
<style>

td,th {
  padding: 15px;
  text-align: center;
  top: 15px;
}

.td2{
  background-color:#EEEEEE;

}

</style>

<header class="clearfix">
    <main >

    <h1 align="center">Centro de Servicio</h1>
    <hr>
    <p>
    <table border="1">
        <tr>
        <center>
          <th class="desc" height="20" class="td2"><b>CLIENTE:</b></th>
          <td class="desc" height="20">'.htmlentities($tres['nombre_cliente'], ENT_QUOTES,'UTF-8').'</td>
          <td class="desc" height="20" class="td2"><b>FOLIO: </b>'.$tres['folio'].'</td>
          <td class="desc" height="20" ><b>Fecha: </b>'.$tres['fecha_entrada'].'</td>
        </center>
        </tr>
        <tr>
          <th class="desc" height="20" class="td2"><b>DIRECCION:</b></th>
          <td class="desc" height="20">'.htmlentities($tres['domicilio'], ENT_QUOTES,'UTF-8').'</td>
          <th class="desc" height="20" class="td2"><b>TELEFONO:</b></th>
          <td class="desc" height="20">'.htmlentities($tres['telefono'], ENT_QUOTES,'UTF-8').'</td>
        </tr>
       
        <tr>
          <th class="td2" height="20"><b>RECIBIO:</b></th>
          <td class="desc" height="20">'.$tres['via_recepcion'].'</td>
          <th class="td2" height="20"><b>HERRAMIENTA:</b></th>
        <td class="desc" height="20">'.$tres['nombre_maquina'].'</td>
        </tr>
        <tr>
          <th class="td2" height="20"><b>TIPO DE SERVICIO:</b></th>
          <td class="desc" height="20">'.htmlentities($tres['tipo_servicio'], ENT_QUOTES,'UTF-8').'</td>
          <th colspan="2" class="td2" height="20"><b>MODELO</b></th>
        </tr>
        <tr>
        <td colspan="2" class="desc" height="20">'.htmlentities($tres['marca'], ENT_QUOTES,'UTF-8').'</td>
          <td colspan="2" class="desc" height="20">'.htmlentities($tres['modelo'], ENT_QUOTES,'UTF-8').'</td>
        </tr>
    </table>
      <p>
    
      
      <table border="1">
        <tr>
          <td colspan="2" height="20"><b>DIAGNOSTICO PREVIO:</b>  '.htmlentities($tres['diagnostico_p'], ENT_QUOTES,'UTF-8').'</td>
        </tr>
        <tr>
          <td colspan="2" class="td2" height="20"><b>REFACCIONES UTILIZADAS</b></td>
        </tr>
        <tr>
          <td width="150" height="20"><b>Cantidad</b></td>
          <td width="150" height="20"><b>Modelo</b></td>
          <td width="330" height="20"><b>Descripcion</b></td>
                      
        </tr>';
    
      if(mysqli_num_rows($repor2)>0){
        while($dos=$repor2->fetch_array()) 
        {
          $html .=
          '<tr>
            <td width="150" class="desc" height="20">'.$dos['cantidad'].'</td>
            <td width="150" class="desc" height="20">'.htmlentities($dos['modelo'], ENT_QUOTES,'UTF-8').'</td>
            <td width="330" class="desc" height="20">'.htmlentities($dos['descripcion'], ENT_QUOTES,'UTF-8').'</td>
          </tr>';
        }
      }
      else
      {
        $html .=
        '<tr>
        <td width="630" colspan="2" class="desc" height="15"> No se han agregado refacciones para el folio '.$tres['folio'].'
        </td>
        </tr>
        ';
      }
          
       $html .='
        
        
        </table>

        <table border="1">
        <tr>
          <td colspan="2" height="20"><b>DIAGNOSTICO REAL:</b>  '.htmlentities($tres1['diagnostico'], ENT_QUOTES,'UTF-8').'</td>
        </tr>
        </table>
';
        
        $html .= '
        <p><p>
          <table >
            <tr>
            <td><h4>COMPROBANTE REALIZADO:</h4></td>
            <td class="total"><h4>COSTO POR REVISION: $'.$tres['costo_estimado'].'</h4></td>
            </tr>
            <tr>
            <td class="total"><h4 >'.$tres['tipo_repara'].'  '.$tres['Num_repara'].'</h4></td>
            <td class="total"><h4 >COSTO REAL:  $'.$tres['costo_real'].'  </h4></td>
            </tr>
            <tr>
                <td colspan="3" class="desc" >
                  <div id="notices" >
                      <div class="autoriza">RECIBO DE CONFORMIDAD</div>
                      <div class="notice">_______________________</div>
                      <div class="autoriza">NOMBRE Y FIRMA</div>
                  </div>
                </td>
            </tr>
            

          </table> 
        <p>
        <p>
        ';

    $html .= '
    <table >
     <tr>
     <td> 
     <center>
     <div  >
        <div ><b>Tecnico: '.$tres1['tecnico'].'</b></div>
        <div class="notice">_______________________</div>
        <div><b>Nombre y Firma</b></div>
        </div>
     </center>
     </td>
     <td>
     <center>
      <div id="notices" >
                      <div ><b>Recibi la herramienta Funcionando Correctamente</b></div>
                      <div class="notice">_______________________</div>
                      <div ><b>Cliente</b></div>
                  </div></td>
                  </center>
     </tr> 
</table>

        ';

$html .='<br><hr>
<p>

<table border="1">

  <tr>
    <th class="td2"><b>FOLIO DE LA ORDEN</b></th>
    <td class="desc" height="15">'.$tres['folio'].'</td>
    <th colspan="2" class="td2" ><b>TALONARIO PARA EL CLIENTE</b></th>
  </tr>
  <tr>
    <th class="td2"><b>Status Orden:</b></th>
    <td>'.$tres1['diagnostico'].' '.$tres1['fecha'].'</td>
    <th height="15" class="td2"><b>Fecha de recepcion en CSA</b></th>
    <td height="15">'.$tres['fecha_entrada'].'</td>
  </tr>
  <tr>
  
  <td colspan="2" height="15" >Mayoreo Ferretero Atlas,S.A. de C.V
  </td>
  <td colspan="2"  height="15" >csa@mayoreoferreteroatlas.com</td>
  </tr>
</table>
</main>
';
$html .='
<p>
<p>

<p align="justify"><B>Por favor conserve este comprobante ya que de lo contrario no se podrá hacer entrega de su producto; Le recordamos recoger su producto dentro de los 30 días naturales después de haber
sido reparado, pasado 90 días naturales, mayoreo ferretero atlas no se hace responsable del producto. Cualquier revision que no sea garantia, causara honorarios.
</p>
<p align="justify"><B>
IMPORTANTE!!! Sin excepcion de personal la reposicion de este comprobante tendra un costo de $100.00 MN. por gastos de ejecucion.
</p>
';

  



// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();



$pdf->Output('orden de trabajo.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>