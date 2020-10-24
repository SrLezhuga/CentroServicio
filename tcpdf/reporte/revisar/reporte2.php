<?php


require_once('tcpdf_include.php');

require_once('../../conexion/conec.php');
$obj=new conect;
	if($obj->conectar()== TRUE)
	{
	session_start();
	if(isset($_SESSION['nick'])and $_SESSION['estado'] == 'autenticado' and $_SESSION['tab_privilegios_id_privilegios'] > '1'  )
	{
	$Empresa=$_SESSION['clave_empresa'];
	$Fecha=date("Y-m-d");
	

	
	
	}
             
		else{
			$obj->desconectar();
		header("location:../../index2.php");  
	}
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

$pdf->AddPage('H', 'A5');
// SACAR EL PROYECTO,PROGRAMA, OBJETIVO

$pdf->setEqualColumns(3, 35);

$pdf->SetFont('helvetica', 'I', 5);



// sacar folio y importe de los ticket activos
$ticketactivos="SELECT folio, importe FROM `tab_ticket` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'  and estado='A'";
$res=mysql_query($ticketactivos);

// saca la suma de los ticket activos
$Sumaactivo="SELECT round(sum(importe),2) as total FROM `tab_ticket` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'  and estado='A'";
$ticketsuma=mysql_query($Sumaactivo);
$sumtikect=mysql_fetch_array($ticketsuma);

//ticlet cancelados
$cancelados="SELECT folio, importe FROM `tab_ticket` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'  and estado='C'";
$cancelados1=mysql_query($cancelados);

//sumad de ticket cancelados
$Sumacance="SELECT round(sum(importe),2) as total FROM `tab_ticket` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'  and estado='C'";
$ticketcance=mysql_query($Sumacance);
$sumcanceticket=mysql_fetch_array($ticketcance);



// sacar folio y importe de los factura activos
$facturaactivos="SELECT a.folio, a.importe, tab_refacturacion.descripcion FROM tab_factura as a LEFT OUTER JOIN tab_refacturacion ON a.folio = tab_refacturacion.folio_new where date(fecha)=date(now()) and a.tab_empresa_clave_empresa='$Empresa' and a.estado='A'";
$factura=mysql_query($facturaactivos);

//saca la suma de las facturas activos
$factusum="SELECT round(sum(importe),2) as total FROM `tab_factura` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'  and estado='A'";
$facturasuma=mysql_query($factusum);
$sumfactura=mysql_fetch_array($facturasuma);

//factura cancelados
$facturacancelados="SELECT folio, importe FROM `tab_factura` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa' and estado!='A'  ";
$facturacancelados1=mysql_query($facturacancelados);
 
 // sumas de las facturas canceladas

$Sumacancefactura="SELECT round(sum(importe),2) as total FROM `tab_factura` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'   and estado!='A' ";
$facturacance=mysql_query($Sumacancefactura);
$sumcancefactura1=mysql_fetch_array($facturacance);



// sacar folio y importe de los tarjeta activos
$tarjetaactivos="SELECT No_movimiento, importe, descripcion FROM tab_tarjeta where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa' and estado='A' ";
$tarjeta=mysql_query($tarjetaactivos);

//saca la suma de las tarjetas activos
$tarjetasum="SELECT round(sum(importe),2) as total FROM `tab_tarjeta` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'  and estado='A'";
$tarjetasuma=mysql_query($tarjetasum);
$sumtarjeta=mysql_fetch_array($tarjetasuma);

//tarjetas cancelados
$tarjetacancelados="SELECT No_movimiento, importe, descripcion FROM `tab_tarjeta` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'  and estado='R'";
$tarjetacancelados1=mysql_query($tarjetacancelados);
 
 // sumas de las tarjetas canceladas

$Sumacancetarjeta="SELECT round(sum(importe),2) as total FROM `tab_tarjeta` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'  and estado='R'";
$tarjetacance=mysql_query($Sumacancetarjeta);
$sumcancetarjeta1=mysql_fetch_array($tarjetacance);



// sacar folio y importe de los cheques activos
$chequeactivos="SELECT No_movimiento, importe, descripcion FROM tab_cheques  where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa' and estado='A' ";
$cheque=mysql_query($chequeactivos);

//saca la suma de las cheques activos
$chequesum="SELECT round(sum(importe),2) as total FROM `tab_cheques` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa' and estado='A'";
$chequesuma=mysql_query($chequesum);
$sumcheque=mysql_fetch_array($chequesuma);

//cheque cancelados
$chequecancelados="SELECT No_movimiento, importe, descripcion FROM `tab_cheques` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa' and estado='R'";
$chequecancelados1=mysql_query($chequecancelados);
 
 // sumas de las cheques canceladas

$Sumacancecheque="SELECT round(sum(importe),2) as total FROM `tab_cheques` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa' and estado='R'";
$chequecance=mysql_query($Sumacancecheque);
$sumcancecheque1=mysql_fetch_array($chequecance);


// sacar folio y importe de los transferencia activos
$transferenciaactivos="SELECT No_movimiento, importe, descripcion FROM tab_transferencia  where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa' and estado='A'";
$transferencia=mysql_query($transferenciaactivos);

//saca la suma de las transferencias activos
$transferenciasum="SELECT round(sum(importe),2) as total FROM `tab_transferencia` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa' and estado='A'";
$transferenciasuma=mysql_query($transferenciasum);
$sumtransferencia=mysql_fetch_array($transferenciasuma);

//transferencia cancelados
$transferenciacancelados="SELECT No_movimiento, importe, descripcion FROM `tab_transferencia` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa' and estado='R'";
$transferenciacancelados1=mysql_query($transferenciacancelados);
 
 // sumas de las transferencia canceladas

$Sumacancetrans="SELECT round(sum(importe),2) as total FROM `tab_transferencia` where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa' and estado='R'";
$transcance=mysql_query($Sumacancetrans);
$sumcancetrans1=mysql_fetch_array($transcance); 
 

//movimiento

$movimiento="SELECT descripcion,importe FROM tab_movimientos where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'";
$movimietos1=mysql_query($movimiento);

$movimientosum="SELECT round(sum(importe),2) as total FROM tab_movimientos where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'";
$movisuma=mysql_query($movimientosum);
$sumsuma=mysql_fetch_array($movisuma);



//SALIDAS

$salida="SELECT nombre,importe FROM tab_retiro where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'";
$salida1=mysql_query($salida);

$salidasum="SELECT round(sum(importe),2) as total FROM tab_retiro where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'";
$salidasuma=mysql_query($salidasum);
$salidasuma1=mysql_fetch_array($salidasuma);

//deposito

$deposito="SELECT folio,importe,descripcion FROM tab_deposito where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'";
$deposito1=mysql_query($deposito);

$depositosum="SELECT round(sum(importe),2) as total FROM tab_deposito where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'";
$depositosuma=mysql_query($depositosum);
$depositosuma1=mysql_fetch_array($depositosuma);

//credito

$credito="SELECT No_movimiento,importe,descripcion FROM tab_credito where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'";
$credito1=mysql_query($credito);

$creditosum="SELECT round(sum(importe),2) as total FROM tab_credito where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa'";
$creditosuma=mysql_query($creditosum);
$creditosuma1=mysql_fetch_array($creditosuma);

//
 // sacar nombre de la fecha
 $name="select nombre_completo from tab_user where tab_empresa_clave_empresa='$Empresa' and tab_privilegios_id_privilegios='3'";
 $name1=mysql_query($name);
 $nombre=mysql_fetch_array($name1);


 $saldo="select *from tab_no_corte where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa' ";
 $saldo1=mysql_query($saldo);
 $saldototal=mysql_fetch_array($saldo1);

 if($saldototal['no_corte']>'1')
 {

 $salini="select saldo_inicial as saldoi from tab_saldos where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa' and no_corte='1'";
 $salini2=mysql_query($salini);
 $saldoinicialtotal=mysql_fetch_array($salini2); 


$saldoinicial=$saldoinicialtotal['saldoi'];
 } 
else
{
 $sinicial="select *from tab_saldoini where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa' ";
 $sinicial1=mysql_query($sinicial);
 $sinicialtotal=mysql_fetch_array($sinicial1);
$saldoinicial=$sinicialtotal['monto_saldoini'];

}


 // sacar la suma de los saldo inicial



//if($saldototal['no_corte']>1)
 //{
 	//$saldoinicial=$saldototal['monto_saldoini']+ $saldoinicialtotal['saldoi'];s
 //}
 //else
 //{


 //saldo inicial 

 $saldo=$saldototal['caja'];



 	//$saldoinicial=$saldoinicialtotal['saldoi'];
 //}

 



 // sacar reporte final
 $sql1="select *from tab_estado_caja where date(fecha)=date(now()) and tab_empresa_clave_empresa='$Empresa' ";
 $consu1=mysql_query($sql1);
 $reporte=mysql_fetch_array($consu1); 
 
 //suma de total de ventas
 $totaldeventas=$sumtikect['total']+$sumfactura['total'];

 //total gastos

 $totalgastos=$sumsuma['total']+$salidasuma1['total']+$depositosuma1['total'];

//saldo final
 $saldof=$saldoinicial+$totaldeventas;
 $saldofinal=$saldof-$totalgastos;

// venta total

 $ventaltotal=$totaldeventas+$sumtarjeta['total']+$sumcheque['total']+$sumtransferencia['total']+$creditosuma1['total'];



//ticket


$html=$html.'<table  align="center" border="1" cellspacing="1" cellpadding="1">';
$html=$html.'<tr>';
$html=$html.'<td colspan="2"><h3>Ticket</h3></td>';
$html=$html.'</tr>';
$html=$html.'<tr>';
$html=$html.'<td>Folio</td><td>Importe</td>';
$html=$html.'</tr>';
 while($datos=mysql_fetch_array($res))
     {

		$html=$html.'<tr><td>';
		$html=$html.$datos["folio"];
		$html=$html.'</td><td>$';
		$html=$html.$datos["importe"];
		$html=$html.'</td></tr>';
		
				
		
     } 

 while($datoscan=mysql_fetch_array($cancelados1))
     {

		$html=$html.'<tr><td bgcolor="#CE2435">';
		$html=$html.$datoscan["folio"];
		$html=$html.'</td><td bgcolor="#CE2435">$';
		$html=$html.$datoscan["importe"];
		$html=$html.'</td> </tr>';
		
				
		
     }

$html=$html.'<tr>';
$html=$html.'<td colspan="2" bgcolor="">Total de ticket</td>';
$html=$html.'</tr>';
$html=$html.'<tr><td colspan="2" bgcolor="black">';
if($sumtikect["total"]>'0')
{
$html=$html.'<h3><font color="white">';
$html=$html.$sumtikect["total"];
$html=$html.'</font></h3>';	
}
else
{
$html=$html.'<h3><font color="white">';
$html=$html."$00.00";
$html=$html.'</font></h3>';	
}

$html=$html.'</td></tr>';
$html=$html.'</table>';
$html=$html.'<p>';

 // factura

$html=$html.'<table  align="center" border="1" cellspacing="1" cellpadding="1">';
$html=$html.'<tr>';
$html=$html.'<td colspan="3"><h3>Factura</h3></td>';
$html=$html.'</tr>';
$html=$html.'<tr>';
$html=$html.'<td>Folio</td><td>Importe</td><td>Descripcion</td>';
$html=$html.'</tr>';
 while($datos1=mysql_fetch_array($factura))
     {

		$html=$html.'<tr><td>';
		$html=$html.$datos1["folio"];
		$html=$html.'</td><td>$';
		$html=$html.$datos1["importe"];
		$html=$html.'</td><td>';
		$html=$html.$datos1["descripcion"];
		$html=$html.'</td></tr>';
		
				
		
     } 

 while($datoscancefactura=mysql_fetch_array($facturacancelados1))
     {

		$html=$html.'<tr><td bgcolor="#CE2435">';
		$html=$html.$datoscancefactura["folio"];
		$html=$html.'</td><td bgcolor="#CE2435">$';
		$html=$html.$datoscancefactura["importe"];
		$html=$html.'</td><td bgcolor="#CE2435">';
		$html=$html.$datoscancefactura["descripcion"];
		$html=$html.'</td></tr>';;
		
				
		
     }

$html=$html.'<tr>';
$html=$html.'<td colspan="3"  bgcolor="">Total las Facturas</td>';
$html=$html.'</tr>';
$html=$html.'<tr><td colspan="3" bgcolor="black">';
if($sumfactura["total"]>'0')
{
$html=$html.'<h3><font color="white">';
$html=$html.$sumfactura["total"];
$html=$html.'</font></h3>';	
}
if($sumfactura["total"]==null)
{
$html=$html.'<h3><font color="white">';
$html=$html."$00.00";
$html=$html.'</font></h3>';	
}

$html=$html.'</td></tr>';
$html=$html.'</table>';
$html=$html.'<p>';


// tarjetas 
$html=$html.'<table  align="center" border="1" cellspacing="1" cellpadding="1">';
$html=$html.'<tr>';
$html=$html.'<td colspan="3"><h3>Tarjetas</h3></td>';
$html=$html.'</tr>';
$html=$html.'<tr>';
$html=$html.'<td>Folio</td><td>Importe</td><td>Descripcion</td>';
$html=$html.'</tr>';
 while($datos2=mysql_fetch_array($tarjeta))
     {

		$html=$html.'<tr><td>';
		$html=$html.$datos2["No_movimiento"];
		$html=$html.'</td><td>$';
		$html=$html.$datos2["importe"];
		$html=$html.'</td><td>';
		$html=$html.$datos2["descripcion"];
		$html=$html.'</td></tr>';
		
				
		
     } 

 while($datoscancetarjeta=mysql_fetch_array($tarjetacancelados1))
     {

		$html=$html.'<tr><td bgcolor="#CE2435">';
		$html=$html.$datoscancetarjeta["No_movimiento"];
		$html=$html.'</td><td bgcolor="#CE2435">$';
		$html=$html.$datoscancetarjeta["importe"];
		$html=$html.'</td><td bgcolor="#CE2435">';
		$html=$html.$datoscancetarjeta["descripcion"];
		$html=$html.'</td></tr>';
	
     }

$html=$html.'<tr>';
$html=$html.'<td colspan="3"  bgcolor="">Total tarjetas</td>';
$html=$html.'</tr>';
$html=$html.'<tr><td colspan="3" bgcolor="black">';
if($sumtarjeta["total"]>'0')
{
$html=$html.'<h3><font color="white">';
$html=$html.$sumtarjeta["total"];
$html=$html.'</font></h3>';	
}
if($sumtarjeta["total"]==null)
{
$html=$html.'<h3><font color="white">';
$html=$html."$00.00";
$html=$html.'</font></h3>';	
}
$html=$html.'</td></tr>';
$html=$html.'</table>';
$html=$html.'<p>';


// Cheques
$html=$html.'<table  align="center" border="1" cellspacing="1" cellpadding="1">';
$html=$html.'<tr>';
$html=$html.'<td colspan="3"><h3>Cheques</h3></td>';
$html=$html.'</tr>';
$html=$html.'<tr>';
$html=$html.'<td>Folio</td><td>Importe</td><td>Descripcion</td>';
$html=$html.'</tr>';
 while($datos3=mysql_fetch_array($cheque))
     {

		$html=$html.'<tr><td>';
		$html=$html.$datos3["No_movimiento"];
		$html=$html.'</td><td>$';
		$html=$html.$datos3["importe"];
		$html=$html.'</td><td>';
		$html=$html.$datos3["descripcion"];
		$html=$html.'</td></tr>';
		
				
		
     } 

 while($datoscancecheque=mysql_fetch_array($chequecancelados1))
     {

		$html=$html.'<tr><td bgcolor="#CE2435">';
		$html=$html.$datoscancecheque["No_movimiento"];
		$html=$html.'</td><td bgcolor="#CE2435">$';
		$html=$html.$datoscancecheque["importe"];
		$html=$html.'</td><td bgcolor="#CE2435">';
		$html=$html.$datoscancecheque["descripcion"];
		$html=$html.'</td></tr >';
	
     }

$html=$html.'<tr>';
$html=$html.'<td colspan="3"  bgcolor="">Total de Cheque</td>';
$html=$html.'</tr>';
$html=$html.'<tr><td colspan="3" bgcolor="black">';
if($sumcheque["total"]>'0')
{
$html=$html.'<h3><font color="white">';
$html=$html.$sumcheque["total"];
$html=$html.'</font></h3>';	
}
else
{
$html=$html.'<h3><font color="white">';
$html=$html."$00.00";
$html=$html.'</font></h3>';	
}
$html=$html.'</td></tr>';
$html=$html.'</table>';
$html=$html.'<p>';


// transferencias
$html=$html.'<table  align="center" border="1" cellspacing="1" cellpadding="1">';
$html=$html.'<tr>';
$html=$html.'<td colspan="3"><h3>Transferencia</h3></td>';
$html=$html.'</tr>';
$html=$html.'<tr>';
$html=$html.'<td>Folio</td><td>Importe</td><td>Descripcion</td>';
$html=$html.'</tr>';
 while($datos4=mysql_fetch_array($transferencia))
     {

		$html=$html.'<tr><td>';
		$html=$html.$datos4["No_movimiento"];
		$html=$html.'</td><td>$';
		$html=$html.$datos4["importe"];
		$html=$html.'</td><td>';
		$html=$html.$datos4["descripcion"];
		$html=$html.'</td></tr>';
		
				
		
     } 

 while($datoscancetrans=mysql_fetch_array($transferenciacancelados1))
     {

		$html=$html.'<tr><td bgcolor="#CE2435">';
		$html=$html.$datoscancetrans["No_movimiento"];
		$html=$html.'</td><td bgcolor="#CE2435">$';
		$html=$html.$datoscancetrans["importe"];
		$html=$html.'</td><td bgcolor="#CE2435">';
		$html=$html.$datoscancetrans["descripcion"];
		$html=$html.'</td></tr>';
		
				
		
     }

$html=$html.'<tr>';
$html=$html.'<td colspan="3"  bgcolor="">Total de transferencia</td>';
$html=$html.'</tr>';
$html=$html.'<tr><td colspan="3" bgcolor="black">';
if($sumtransferencia["total"]>'0')
{
$html=$html.'<h3><font color="white">';
$html=$html.$sumtransferencia["total"];
$html=$html.'</font></h3>';	
}
else
{
$html=$html.'<h3><font color="white">';
$html=$html."$00.00";
$html=$html.'</font></h3>';	
}
$html=$html.'</td></tr>';
$html=$html.'</table>';
$html=$html.'<p>';

// Credito
$html=$html.'<table  align="center" border="1" cellspacing="1" cellpadding="1">';
$html=$html.'<tr>';
$html=$html.'<td colspan="3"><h3>Credito</h3></td>';
$html=$html.'</tr>';

$html=$html.'<tr>';
$html=$html.'<td>Folio</td><td>Importe</td><td >Descripcion</td>';
$html=$html.'</tr>';
 while($cred=mysql_fetch_array($credito1))
     {

		$html=$html.'<tr><td>';
		$html=$html.$cred["No_movimiento"];
		$html=$html.'</td><td>$';
		$html=$html.$cred["importe"];
		$html=$html.'</td><td>';
		$html=$html.$cred["descripcion"];
		$html=$html.'</td></tr>';
		
			
		
     } 
     
$html=$html.'<tr>';
$html=$html.'<td colspan="3"  bgcolor="">Total Credito</td>';
$html=$html.'</tr>';    
$html=$html.'<tr><td colspan="3" bgcolor="black">';
if($creditosuma1["total"]>'0')
{
$html=$html.'<h3><font color="white">';
$html=$html.$creditosuma1["total"];
$html=$html.'</font></h3>';	
}
else
{
$html=$html.'<h3><font color="white">';
$html=$html."$00.00";
$html=$html.'</font></h3>';	
}
$html=$html.'</td></tr>';
$html=$html.'</table>';
$html=$html.'<p>';





// moovimientos
$html=$html.'<table  align="center" border="1" cellspacing="1" cellpadding="1">';
$html=$html.'<tr>';
$html=$html.'<td colspan="3"><h3>Gastos</h3></td>';
$html=$html.'</tr>';

$html=$html.'<tr>';
$html=$html.'<td>Folio</td><td colspan="2">Importe</td>';
$html=$html.'</tr>';
 while($datos5=mysql_fetch_array($movimietos1))
     {

		$html=$html.'<tr><td>';
		$html=$html.$datos5["descripcion"];
		$html=$html.'</td><td colspan="2">$';
		$html=$html.$datos5["importe"];
		$html=$html.'</td></tr>';
		
			
		
     } 
     
$html=$html.'<tr>';
$html=$html.'<td colspan="3"  bgcolor="">Total de Gastos</td>';
$html=$html.'</tr>';    
$html=$html.'<tr><td colspan="3" bgcolor="black">';
if($sumsuma["total"]>'0')
{
$html=$html.'<h3><font color="white">';
$html=$html.$sumsuma["total"];
$html=$html.'</font></h3>';	
}
else
{
$html=$html.'<h3><font color="white">';
$html=$html."$00.00";
$html=$html.'</font></h3>';	
}
$html=$html.'</td></tr>';
$html=$html.'</table>';
$html=$html.'<p>';


// Deposito
$html=$html.'<table  align="center" border="1" cellspacing="1" cellpadding="1">';
$html=$html.'<tr>';
$html=$html.'<td colspan="3"><h3>Deposito</h3></td>';
$html=$html.'</tr>';

$html=$html.'<tr>';
$html=$html.'<td>Folio</td><td>Importe</td><td >Descripcion</td>';
$html=$html.'</tr>';
 while($datos7=mysql_fetch_array($deposito1))
     {

		$html=$html.'<tr><td>';
		$html=$html.$datos7["folio"];
		$html=$html.'</td><td>$';
		$html=$html.$datos7["importe"];
		
		$html=$html.'</td><td>';

		$html=$html.$datos7["descripcion"];
		$html=$html.'</td></tr>';
		
			
		
     } 
     
$html=$html.'<tr>';
$html=$html.'<td colspan="3"  bgcolor="">Total Deposito</td>';
$html=$html.'</tr>';    
$html=$html.'<tr><td colspan="3" bgcolor="black">';
if($depositosuma1["total"]>'0')
{
$html=$html.'<h3><font color="white">';
$html=$html.$depositosuma1["total"];
$html=$html.'</font></h3>';	
}
else
{
$html=$html.'<h3><font color="white">';
$html=$html."$00.00";
$html=$html.'</font></h3>';	
}
$html=$html.'</td></tr>';
$html=$html.'</table>';
$html=$html.'<p>';


// Retiro
$html=$html.'<table  align="center" border="1" cellspacing="1" cellpadding="1">';
$html=$html.'<tr>';
$html=$html.'<td colspan="3"><h3>Retiro</h3></td>';
$html=$html.'</tr>';

$html=$html.'<tr>';
$html=$html.'<td>Folio</td><td colspan="2">Importe</td>';
$html=$html.'</tr>';
 while($dat2=mysql_fetch_array($salida1))
     {

		$html=$html.'<tr><td>';
		$html=$html.$dat2["nombre"];
		$html=$html.'</td><td colspan="2">$';
		$html=$html.$dat2["importe"];
		
		$html=$html.'</td></tr>';
		
			
		
     } 
     
$html=$html.'<tr>';
$html=$html.'<td colspan="3"  bgcolor="">Total Retiro</td>';
$html=$html.'</tr>';    
$html=$html.'<tr><td colspan="3" bgcolor="black">';
if($salidasuma1["total"]>'0')
{
$html=$html.'<h3><font color="white">';
$html=$html.$salidasuma1["total"];
$html=$html.'</font></h3>';	
}
else
{
$html=$html.'<h3><font color="white">';
$html=$html."$00.00";
$html=$html.'</font></h3>';	
}
$html=$html.'</td></tr>';
$html=$html.'</table>';
$html=$html.'<p>';





$html=$html.'<p align="center" bgcolor="#B8FCB7"><h3>REPORTE FINAL</h3></p>';
		$html=$html.'<table border="1"  align="center">';
		$html=$html.'<tr><td>Empresa</td><td>';
		$html=$html.$Empresa;
		$html=$html.'</td> </tr><tr><td>Fecha</td><td>';
		$html=$html.$Fecha;
		$html=$html.'</td></tr><tr><td>Saldo Inicial</td><td>';
		if($saldoinicial>'0')
		{
		$html=$html.'$';
		$html=$html.$saldoinicial;	
		}
		else
		{
		$html=$html."$00.00";
		}
		$html=$html.'</td></tr>';
		$html=$html.'<tr><td>Total de Ventas</td><td>';
		if($totaldeventas>'0')
		{
		$html=$html.'$';
		$html=$html.$totaldeventas;	
		}
		else
		{
		$html=$html."$00.00";
		}
		$html=$html.'</td></tr><tr><td>Total Gastos</td><td>';
		if($totalgastos>'0')
		{
		$html=$html.'$';
		$html=$html.$totalgastos;	
		}
		else
		{
		$html=$html."$00.00";
		}
		$html=$html.'</td></tr><tr><td>Saldo Final</td><td>';
		if($saldofinal>'0')
		{
		$html=$html.'$';	
		$html=$html.$saldofinal;	
		}
		else
		{
		$html=$html."$00.00";
		}
		$html=$html.'</td></tr><tr><td bgcolor="black"><font color="white">Venta Total</font></td><td bgcolor="black"><font color="white">';
		if($ventaltotal>'0')
		{
		$html=$html.'$';
		$html=$html.$ventaltotal;	
		}
		else
		{
		$html=$html."$00.00";
		}
		$html=$html.'</font></td></tr>';
		
		$html=$html.'</table>';
		
		$html=$html.'<br><br>';

		$html=$html.'Nombre de la cajera:  ';
		$html=$html.$nombre['nombre_completo'];
			

		$html=$html.'<br><br>';	

		$html=$html.'Saldo inicial para el siguiente corte es de:  $';
		$html=$html.$saldo;
 		$html=$html.'   Por concepto de saldo inicial ingresado por el administrador mas las ventas despues del corte ';

 		
	



// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
//$this->writeHTML($content, true, false, true, false, 'J');

// reset pointer to the last page
$pdf->lastPage();



$pdf->Output('Corte de caja.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>