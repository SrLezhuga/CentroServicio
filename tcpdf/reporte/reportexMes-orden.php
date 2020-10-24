<?php


require_once('tcpdf_include.php');

require_once('../../conexion/conec.php');
$db=new Conexion();
    session_start();
	if(isset($_SESSION['nick'])and $_SESSION['estado'] == 'autenticado' and $_SESSION['privilegios_user_id'] >= '1'  )
	{
	
	//$Fecha=date("Y-m-d");
	$Status=$_POST['status'];
	$fechauno=$_POST['fecha1'];
	$fechados=$_POST['fecha2'];
	
	
	}
             
		else{
			
		header("location:../../index.php");  
	}


class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		
		$image_file = K_PATH_IMAGES.'ferretero.PNG';
		$this->Image($image_file, 15, 5, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B',10);
		// Title
		$this->Cell(0, 15, 'MAYOREO FERRETERO ATLAS SA DE CV', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(5);
		$this->SetFont('helvetica', 'B',7);
		$this->Cell(0, 15, '                                           RFC MFA030403T73', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(5);
		$this->Cell(0, 15, '                                            CALZADA INDEPENDENCIA SUR #375', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(5);
		$this->Cell(0, 15, '                                            GUADALAJARA JALISCO MEXICO CP 44450 '. $fecha, 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(5);
		
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
Ob_end_clean();
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Reporte Centro de Servicio');
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

$pdf->AddPage('H', 'A5');
// SACAR EL PROYECTO,PROGRAMA, OBJETIVO

$pdf->setEqualColumns(1, 35);

$pdf->SetFont('helvetica', 'I', 5);




// ********************************************
if($Status=="Todos"){

$orden="SELECT * FROM tab_orden_reparo where date(fecha_entrada) between '$fechauno' and '$fechados'  ORDER BY
status_orden ASC";
}else{

$orden="SELECT * FROM tab_orden_reparo where date(fecha_entrada) between '$fechauno' and '$fechados' and status_orden='$Status'  ORDER BY
folio ASC";}
mysqli_query("SET NAMES 'utf8'");
$res=$db->query($orden);

$html=$html.'<p><b>DE LA FECHA: '.$fechauno.'  A: '.$fechados.' -------- ------ ------- ------ -------- ------ ------- ------ -------- ------ ------- ------   -------- ------ Status: '.$Status.'</B></P>';


if(mysqli_num_rows($res)>0)
{
$html=$html.'<table  align="center" border="1" cellspacing="1" cellpadding="1">';
$html=$html.'<tr>';
$html=$html.'<td colspan="7"><h3>REPORTE DE SERVICIOS</h3></td>';
$html=$html.'</tr>';
$html=$html.'<tr>';
$html=$html.'<td bgcolor="black"><font color="white">FOLIO</font></td><td bgcolor="black"><font color="white">CLIENTE</font></td><td bgcolor="black"><font color="white">TIPO DE SERVICIO</font></td><td bgcolor="black"><font color="white">MAQUINA</font></td><td bgcolor="black"><font color="white">FECHA ENTRADA</font></td><td bgcolor="black"><font color="white">Tecnico</font></td><td bgcolor="black"><font color="white">Status Orden</font></td>';
$html=$html.'</tr>';
 while($datos=$res->fetch_array())
     {

		$html=$html.'<tr><td>';
		$html=$html.$datos["folio"];
		$html=$html.'</td><td>';
		$html=$html.$datos["nombre_cliente"];
		$html=$html.'</td>';
		
		$html=$html.'<td>';
		$html=$html.$datos["tipo_servicio"];
		$html=$html.'</td>';
		$html=$html.'<td>';
		$html=$html.$datos["nombre_maquina"];
		$html=$html.'</td><td>';
		$html=$html.$datos["fecha_entrada"];
		$html=$html.'</td>';
		$html=$html.'<td>';
		$html=$html.$datos["recepcion"];
		$html=$html.'</td>';
		$html=$html.'<td>';
		$html=$html.$datos["status_orden"];
		$html=$html.'</td></tr>';
		
		
		
		
		
				
		
     }

$html=$html.'</table>';
}
else
{
	$html=$html.'<h1>No hay reporte con los datos Especificos</h1>';
}


// ********************************************




// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
//$this->writeHTML($content, true, false, true, false, 'J');

// reset pointer to the last page
$pdf->lastPage();



$pdf->Output('CSA.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>