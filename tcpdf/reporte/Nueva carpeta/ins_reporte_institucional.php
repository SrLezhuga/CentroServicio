<?php


require_once('tcpdf_include.php');

require_once('../../conec.php');
$obj=new conect;
	if($obj->conectar()== TRUE)
	{


	session_start();
	$periodo=$_SESSION['id_periodo'];  
	if(isset($_SESSION['usuario'])and $_SESSION['estado'] == 'autenticado' and $_SESSION['tipo_usuario']=='1')
	{
     
	  
	  
	}             
		else{
			$obj->desconectar();
		header("location:../../index.php");  
	}
}

///require_once('consulta.php');
	
 

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		 $peri="select *from periodos where id_periodo='$_SESSION[id_periodo]'";
		 $peri1=mysql_query($peri);
		 $peri2=mysql_fetch_array($peri1);
	     $fecha=substr($peri2['fecha_inicio'],0,4);
	  
		$image_file = K_PATH_IMAGES.'sep.PNG';
		$this->Image($image_file, 15, 5, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B',9);
		// Title
		$this->Cell(0, 15, 'TECNOLOGICO NACIONAL DE MEXICO', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(4);
		$this->SetFont('helvetica', 'B',7);
		$this->Cell(0, 15, '                                                          SECRETARIA DE PLANEACION, EVALUACION Y DESARROLLO INSTITUCINAL', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(4);
		$this->Cell(0, 15, '                                                           DIRECCION DE EVALUACION Y PLANEACION', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(4);
		$this->Cell(0, 15, '                                                           PROGRAMA INSTITUCIONAL ANUAL '.$fecha,0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(4);
		 $this->SetFont('helvetica', 'B',8);
$this->Cell(0, 20, '         INSTITUTO TECNOLOGICO O CENTRO:  Instituto Tecnologico De Frontera Comalapa', 0, false, 'L', 0, '', 0, false, 'M', 'M');
$this->Ln(1);
$this->Cell(0, 15, '                                                                               __________________________________________________________________________', 0, false, 'L', 0, '', 0, false, 'M', 'M');

$this->Ln(4);
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
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Reporte Institucional');
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

$pdf->AddPage('L','A5');
// SACAR EL PROYECTO,PROGRAMA, OBJETIVO


$pdf->SetFont('helvetica', 'I', 5);

 $sqlString="SELECT DISTINCT * FROM `_vm_reporte-institucional` where id_periodo='$periodo'  order by id_programa,id_proyecto,id_indicador_proyecto";
 $res=mysql_query($sqlString);
			
  $compa=mysql_num_rows($res);
  if($compa>0)
  {			//$row=mysql_fetch_array($res);
	  		
$row = mysql_fetch_array($res);
			
$html=$html.'<table align="right">';
$html=$html.'<tr><td width="640"><h2>Porgrama:';
$html=$html.$row["id_programa"].$row["proceso_estrategico"];
$html=$html.'</h2></td></tr><td></td></tr>'; 
$html=$html.'</table>';           
$html=$html.'<table border="1" align="center">';
$html=$html.'

<tr>
	<td rowspan="3" width="70">Proyecto</td>
	<td rowspan="3" width="60">Indicador</td>
	<td rowspan="3" width="50">Formula</td>
	<td rowspan="3" width="40">Cantidad</td>
	<td rowspan="3" width="60">Acciones</td>
	<td colspan="7" width="230">Monto de recursos por Capitulo de Gasto</td>
	<td rowspan="2" colspan="2">Presupuesto a cubrir a travez de</td>
	<td rowspan="3">Total Presupuesto</td>
</tr>

<tr>
<td width="30">1000</td>
<td colspan="2" width="70">2000</td>
<td colspan="2" width="70">3000</td>
<td width="30">4000</td>
<td width="30">5000</td>
</tr>

<tr>
<td>Ingreso propio</td>
<td>Ingreso propio</td>
<td>Gasto directo</td>
<td>Ingreso propio</td>
<td>Gasto directo</td>
<td>Ingreso propio</td>
<td>Ingreso propio</td>
<td>Ingreso propio</td>
<td>Gasto directo</td>
</tr>

';
 $html=$html.'</table>';	  	    

	  	    $html=$html.'<table>';
	  	    
	  	    //$html=$html.'<tr><td>proyecto</td><td>indicadores</td><td>acciones</td><td>1000</td><td>2000</td><td>3000</td><td>4000</td><td>5000</td><td>Ingreso propios</td><td>Total Presupuestal</td></tr>';
	  		//$html=$html.'</table>'; 
	  	   
	  		
	  		//if($row = mysql_fetch_array($res))
	  	
	  		$total=$row["importecap1000"]+$row["importecap2000"]+$row["importecap3000"]+$row["importecap4000"]+$row["importecap5000"];
	  		

	  	   	$html=$html.'<tr><td></td></tr>';
            $html=$html.'<tr><td width="70">';
            $html=$html.$row["id_proyecto"].$row["proceso_clave"];
            $html=$html.'</td><td width="60">';
            $html=$html.$row["id_indicador_proyecto"].$row["indicadores_proyecto"];
            $html=$html.'</td><td width="50">';
            $html=$html.$row["formula_indicador_proyecto"];
            $html=$html.'</td><td width="40" align="center">';
            $html=$html.$row["cantidad_total"];
            $html=$html.'</td><td width="60">';
            $html=$html.$row["clave_linea_accion"].$row["linea_accion"];
            $html=$html.'</td><td width="30" align="right">';
            $html=$html.$row["importecap1000"];
            $html=$html.'</td><td width="35" align="right">';
            $html=$html.$row["importecap2000"];
            $html=$html.'</td><td width="35" align="right"></td><td width="35" align="right">';
            $html=$html.$row["importecap3000"];
            $html=$html.'</td><td width="35" align="right"></td><td width="30" align="right">';
            $html=$html.$row["importecap4000"];
            $html=$html.'</td><td width="30" align="right">';
            $html=$html.$row["importecap5000"];
            $html=$html.'</td><td width="43" align="right">';
            $html=$html.$total;
            $html=$html.'</td><td width="43" align="right"></td><td width="42" align="right">';
            $html=$html.$total;
            $html=$html.'</td></tr>';
		       $proyecto=$row["id_proyecto"];
		       $indicador=$row["id_indicador_proyecto"];
		       $programa=$row["id_programa"];
		         $can1000=$can1000+$row["importecap1000"];
		         $can2000=$can2000+$row["importecap2000"];
				 $can3000=$can300o+$row["importecap3000"];
				 $can4000=$can4000+$row["importecap4000"];
				 $can5000=$can5000+$row["importecap5000"];
				 $totalproy= $can1000+$can2000+$can3000+$can4000+$can5000;
				 $total="0";
				 
				while ($row1=mysql_fetch_array($res))
	  		 	{

	  		 	if($row1["id_programa"]==$programa)
	  		 	{


	  		 	if($row1["id_proyecto"]==$proyecto)
	  			{
	  						
	  						if($row1["id_indicador_proyecto"]==$indicador)
	  						{
	  							 
	  							 if($row1["clave_linea_accion"]==$row["clave_linea_accion"])
				  					{
				  						
				  					}
				  					else
				  					{
				  						$total=$row1["importecap1000"]+$row1["importecap2000"]+$row1["importecap3000"]+$row1["importecap4000"]+$row1["importecap5000"];
	  			                        
	  			                        $html=$html.'<tr><td width="70"></td><td width="60"></td><td width="50">';
	  			                        $html=$html.'</td><td width="40">';
           					            $html=$html.'</td><td width="60">';
				  						$html=$html.$row1["clave_linea_accion"].$row1["linea_accion"];
				  						 $html=$html.'</td><td width="30" align="right">';
							            $html=$html.$row1["importecap1000"];
							            $html=$html.'</td><td width="35" align="right">';
							            $html=$html.$row1["importecap2000"];
							            $html=$html.'</td><td width="35" align="right"></td><td width="35" align="right">';
							            $html=$html.$row1["importecap3000"];
							            $html=$html.'</td><td width="35" align="right"></td><td width="30" align="right">';
							            $html=$html.$row1["importecap4000"];
							            $html=$html.'</td><td width="30" align="right">';
							            $html=$html.$row1["importecap5000"];
							            $html=$html.'</td><td width="43" align="right">';
							            $html=$html.$total;
							            $html=$html.'</td><td width="43" align="right"></td><td width="42" align="right">';
							            $html=$html.$total;
							            $html=$html.'</td></tr>';
				  						$can1000=$can1000+$row1["importecap1000"];
									    $can2000=$can2000+$row1["importecap2000"];
									    $can3000=$can3000+$row1["importecap3000"];
									    $can4000=$can4000+$row1["importecap4000"];
									    $can5000=$can5000+$row1["importecap5000"];
									    $total="0";
									    $totalproy= $can1000+$can2000+$can3000+$can4000+$can5000;  
											  					
				  					}

	  						}
	  						else
	  						{
	  							$total=$row1["importecap1000"]+$row1["importecap2000"]+$row1["importecap3000"]+$row1["importecap4000"]+$row1["importecap5000"];
	  			     
	  							$html=$html.'<tr><td width="70"></td><td width="60">';
	  							$html=$html.$row1["id_indicador_proyecto"].$row1["indicadores_proyecto"];
								$html=$html.'</td><td width="50">';
								 $html=$html.$row1["formula_indicador_proyecto"];
            					$html=$html.'</td><td width="40" align="center">';
           						 $html=$html.$row1["cantidad_total"];
            					$html=$html.'</td><td width="60">';
								$html=$html.$row1["clave_linea_accion"].$row1["linea_accion"];
								$html=$html.'</td><td width="30" align="right">';
						        $html=$html.$row1["importecap1000"];
						        $html=$html.'</td><td width="35" align="right">';
						        $html=$html.$row1["importecap2000"];
						        $html=$html.'</td><td width="35" align="right"></td><td width="35" align="right">';
						        $html=$html.$row1["importecap3000"];
						        $html=$html.'</td><td width="35" align="right"></td><td width="30" align="right">';
						        $html=$html.$row1["importecap4000"];
						        $html=$html.'</td><td width="30" align="right">';
						        $html=$html.$row1["importecap5000"];
						        $html=$html.'</td><td width="43" align="right">';
						        $html=$html.$total;
						        $html=$html.'</td><td width="43" align="right"></td><td width="42" align="right">';
						        $html=$html.$total;
						        $html=$html.'</td></tr>';
	  							$can1000=$can1000+$row1["importecap1000"];
								$can2000=$can2000+$row1["importecap2000"];
								$can3000=$can3000+$row1["importecap3000"];
								$can4000=$can4000+$row1["importecap4000"];
								$can5000=$can5000+$row1["importecap5000"];

								$proyecto=$row1["id_proyecto"];
	  							$indicador=$row1["id_indicador_proyecto"];
	  							$total="0";
	  							$totalproy= $can1000+$can2000+$can3000+$can4000+$can5000;	
	  						}	
	  			}
	  			else
	  			{

	  			
	  	   // $html=$html.'</table>';
	  		$html=$html.'<tr><td></td></tr>';		
	  	    $html=$html.'<table border="1">';	
	  			
	  			$html=$html.'<tr bgcolor="#D9DAD9"><td width="280" align="right">TOTAL POR PROYECTO</td><td width="30" align="right">';
	  			$html=$html.$can1000;
	  			$html=$html.'</td><td  width="35" align="right">';
	  			$html=$html.$can2000;
	  			$html=$html.'</td><td  width="35" align="right"></td><td width="35" align="right">';
	  			$html=$html.$can3000;
	  			$html=$html.'</td><td width="35" align="right"></td><td width="30" align="right">';
	  			$html=$html.$can4000;
	  			$html=$html.'</td><td width="30" align="right">';
	  			$html=$html.$can5000;
	  			$html=$html.'</td><td width="43" align="right">';
	  			$html=$html.$totalproy;
	  			$html=$html.'</td><td width="43" align="right"></td><td width="42" align="right">';
	  			$html=$html.$totalproy;
	  			$html=$html.'</td></tr>';
	  			$toprograma1000=$toprograma1000+$can1000;
				$toprograma2000=$toprograma2000+$can2000;
				$toprograma3000=$toprograma3000+$can3000;
				$toprograma4000=$toprograma4000+$can4000;
				$toprograma5000=$toprograma5000+$can5000;
				$totalprograpro=$totalprograpro+$totalproy;
                $can1000="0";
			    $can2000="0";
				$can3000="0";
				$can4000="0";
				$can5000="0";


	  	   $html=$html.'</table>';
	  	   // $html=$html.'<table border="1">';
	  			
				$totalproy="0";
	  			$total=$row1["importecap1000"]+$row1["importecap2000"]+$row1["importecap3000"]+$row1["importecap4000"]+$row1["importecap5000"];
	  			$html=$html.'<tr><td></td></tr>';	
                $html=$html.'<tr><td width="70">';
                $html=$html.$row1["id_proyecto"].$row1["proceso_clave"];
                $html=$html.'</td><td width="60">';
                $html=$html.$row1["id_indicador_proyecto"].$row1["indicadores_proyecto"];
				$html=$html.'</td><td width="50">';
				$html=$html.$row1["formula_indicador_proyecto"];
            	$html=$html.'</td><td width="40" align="center">';
           		$html=$html.$row1["cantidad_total"];
            	$html=$html.'</td><td width="60">';
				$html=$html.$row1["clave_linea_accion"].$row1["linea_accion"];
				$html=$html.'</td><td width="30" align="right">';
				$html=$html.$row1["importecap1000"];
				$html=$html.'</td><td width="35" align="right">';
				$html=$html.$row1["importecap2000"];
				$html=$html.'</td><td width="35" align="right"></td><td width="35" align="right">';
				$html=$html.$row1["importecap3000"];
				$html=$html.'</td><td width="35" align="right"></td><td width="30" align="right">';
				$html=$html.$row1["importecap4000"];
				$html=$html.'</td><td width="30" align="right">';
				$html=$html.$row1["importecap5000"];
				$html=$html.'</td><td width="43" align="right">';
				$html=$html.$total;
				$html=$html.'</td><td width="43" align="right"></td><td width="42" align="right">';
				$html=$html.$total;
				$html=$html.'</td></tr>';
				$proyecto=$row1["id_proyecto"];
	  			$indicador=$row1["id_indicador_proyecto"];
	  			$programa=$row1["id_programa"];
	  			$can1000=$can1000+$row1["importecap1000"];
				$can2000=$can2000+$row1["importecap2000"];
				$can3000=$can3000+$row1["importecap3000"];
				$can4000=$can4000+$row1["importecap4000"];
				$can5000=$can5000+$row1["importecap5000"];
				$total="0";	
	  			$totalproy= $can1000+$can2000+$can3000+$can4000+$can5000;	
				
					
			
	  			
	  			}	  		 	
	  		}


	  		 	else
	  		 	{
             //$html=$html.'</table>';
	  		 $html=$html.'<tr><td></td></tr>';		
	  	    $html=$html.'<table border="1">';
	  	   	
	  		 $totalproy= $can1000+$can2000+$can3000+$can4000+$can5000;	
             $html=$html.'<tr bgcolor="#D9DAD9"><td width="280" align="right">TOTAL POR PROYECTO</td><td width="30" align="right">';
	  			$html=$html.$can1000;
	  			$html=$html.'</td><td  width="35" align="right">';
	  			$html=$html.$can2000;
	  			$html=$html.'</td><td  width="35" align="right"></td><td width="35" align="right">';
	  			$html=$html.$can3000;
	  			$html=$html.'</td><td width="35" align="right"></td><td width="30" align="right">';
	  			$html=$html.$can4000;
	  			$html=$html.'</td><td width="30" align="right">';
	  			$html=$html.$can5000;
	  			$html=$html.'</td><td width="43" align="right">';
	  			$html=$html.$totalproy;
	  			$html=$html.'</td><td width="43" align="right"></td><td width="42" align="right">';
	  			$html=$html.$totalproy;
	  			$html=$html.'</td></tr>';
              $html=$html.'</table>';
			    $toprograma1000=$toprograma1000+$can1000;
				$toprograma2000=$toprograma2000+$can2000;
				$toprograma3000=$toprograma3000+$can3000;
				$toprograma4000=$toprograma4000+$can4000;
				$toprograma5000=$toprograma5000+$can5000;
                $totalprograpro=$totalprograpro+$totalproy;
			
			  $html=$html.'<table border="1">';
			 $html=$html.'<tr><td width="280" align="right"><h4>TOTAL POR PROGRAMA INSTITUCIONAL</h4></td><td width="30" align="right"><h4>';
			 $html=$html.$toprograma1000;
			 $html=$html.'</h4></td><td width="35" align="right"><h4>';
			 $html=$html.$toprograma2000;
			 $html=$html.'</h4></td><td width="35" align="right"></td><td width="35" align="right"><h4>';
			 $html=$html.$toprograma3000;
			 $html=$html.'</h4></td><td width="35" align="right"></td><td width="30"  align="right"><h4>';
			 $html=$html.$toprograma4000;
			 $html=$html.'</h4></td><td width="30" align="right"><h4>';
			 $html=$html.$toprograma5000;
			 $html=$html.'</h4></td><td width="43" align="right"><h4>';
			 $html=$html.$totalprograpro;
			 $html=$html.'</h4></td><td width="43" align="right"></td><td width="42" align="right"><h4>';
			 $html=$html.$totalprograpro;
			 $html=$html.'</h4></td></tr>';
			 $total1=$total1+$toprograma1000;
			 $total2=$total2+$toprograma2000;
			 $total3=$total3+$toprograma3000;
			 $total4=$total4+$toprograma4000;
			 $total5=$total5+$toprograma5000;
			 $totalt=$totalt+$totalprograpro;
			 $toprograma1000="0";
			$toprograma2000="0";
				$toprograma3000="0";
				$toprograma4000="0";
				$toprograma5000="0";
				$totalprograpro="0";
			    $can1000="0";
			    $can2000="0";
				$can3000="0";
				$can4000="0";
				$can5000="0";

	  		 
	  		  $html=$html.'</table>';
           $html=$html.'<tr><td></td></tr>';
	       
	  		 $html=$html.'<table align="right">';
			$html=$html.'<tr><td><h2>Porgrama:';
			$html=$html.$row1["id_programa"].$row1["proceso_estrategico"];
			$html=$html.'</h2></td></tr><tr><td></td></tr>';
              $html=$html.'</table>';

              $html=$html.'<table border="1" align="center">';

			$html=$html.'<tr>
	<td rowspan="3" width="70">Proyecto</td>
	<td rowspan="3" width="60">Indicador</td>
	<td rowspan="3" width="50">Formula</td>
	<td rowspan="3" width="40">Cantidad</td>
	<td rowspan="3" width="60">Acciones</td>
	<td colspan="7" width="230">Monto de recursos por Capitulo de Gasto</td>
	<td rowspan="2" colspan="2">Presupuesto a cubrir a travez de</td>
	<td rowspan="3">Total Presupuesto</td>
</tr>

<tr>
<td width="30">1000</td>
<td colspan="2" width="70">2000</td>
<td colspan="2" width="70">3000</td>
<td width="30">4000</td>
<td width="30">5000</td>
</tr>

<tr>
<td>Ingreso propio</td>
<td>Ingreso propio</td>
<td>Gasto directo</td>
<td>Ingreso propio</td>
<td>Gasto directo</td>
<td>Ingreso propio</td>
<td>Ingreso propio</td>
<td>Ingreso propio</td>
<td>Gasto directo</td>
</tr>'
	  		;
	  		$html=$html.'</table>';

	  		$total=$row1["importecap1000"]+$row1["importecap2000"]+$row1["importecap3000"]+$row1["importecap4000"]+$row1["importecap5000"]; 
	  	//	$html=$html.'<table border="1">';
	  		$html=$html.'<tr><td></td></tr>';	
	  		$html=$html.'<tr><td width="70">';
	  		$html=$html.$row1["id_proyecto"].$row1["proceso_clave"];
	  		$html=$html.'</td><td width="60">';
	  		$html=$html.$row1["id_indicador_proyecto"].$row1["indicadores_proyecto"];
	  		$html=$html.'</td><td width="50">';
	  		$html=$html.$row1["formula_indicador_proyecto"];
            $html=$html.'</td><td width="40" align="center">';
           	$html=$html.$row1["cantidad_total"];
            $html=$html.'</td><td width="60">';
	  		$html=$html.$row1["clave_linea_accion"].$row1["linea_accion"];
	  		$html=$html.'</td><td width="30" align="right">';
			$html=$html.$row1["importecap1000"];
			$html=$html.'</td><td width="35" align="right">';
			$html=$html.$row1["importecap2000"];
			$html=$html.'</td><td width="35" align="right"></td><td width="35" align="right">';
			$html=$html.$row1["importecap3000"];
			$html=$html.'</td><td width="35" align="right"></td><td width="30" align="right">';
			$html=$html.$row1["importecap4000"];
			$html=$html.'</td><td width="30" align="right">';
			$html=$html.$row1["importecap5000"];
			$html=$html.'</td><td width="43" align="right">';
			
			$html=$html.$total;
			$html=$html.'</td><td width="43" align="right"></td><td width="42" align="right">';
			$html=$html.$total;
			$html=$html.'</td></tr>';
			$total="0";	
	  		    $proyecto=$row1["id_proyecto"];
	  			$indicador=$row1["id_indicador_proyecto"];
	  			$programa=$row1["id_programa"];
	  			$can1000=$can1000+$row1["importecap1000"];
				$can2000=$can2000+$row1["importecap2000"];
				$can3000=$can3000+$row1["importecap3000"];
				$can4000=$can4000+$row1["importecap4000"];
				$can5000=$can5000+$row1["importecap5000"];
	  		 	$totalproy= $can1000+$can2000+$can3000+$can4000+$can5000;
                

	  		 	}

	  		}

	  		

//$html=$html.'</table>';
$html=$html.'<tr><td></td></tr>';
$html=$html.'<table border="1">';

$totalproy= $can1000+$can2000+$can3000+$can4000+$can5000;	
             $html=$html.'<tr bgcolor="#D9DAD9"><td width="280" align="right">TOTAL POR PROYECTO</td><td width="30" align="right">';
	  			$html=$html.$can1000;
	  			$html=$html.'</td><td  width="35" align="right">';
	  			$html=$html.$can2000;
	  			$html=$html.'</td><td  width="35" align="right"></td><td width="35" align="right">';
	  			$html=$html.$can3000;
	  			$html=$html.'</td><td width="35" align="right"></td><td width="30" align="right">';
	  			$html=$html.$can4000;
	  			$html=$html.'</td><td width="30" align="right">';
	  			$html=$html.$can5000;
	  			$html=$html.'</td><td width="43" align="right">';
	  			$html=$html.$totalproy;
	  			$html=$html.'</td><td width="43" align="right"></td><td width="42" align="right">';
	  			$html=$html.$totalproy;
	  			$html=$html.'</td></tr>';
 $toprograma1000=$toprograma1000+$can1000;
 $toprograma2000=$toprograma2000+$can2000;
 $toprograma3000=$toprograma3000+$can3000;
 $toprograma4000=$toprograma4000+$can4000;
 $toprograma5000=$toprograma5000+$can5000;
 $totalprograpro=$totalprograpro+$totalproy;
 
$html=$html.'</table>';
$html=$html.'<table border="1">';
 $html=$html.'<tr><td width="280" align="right"><h4>TOTAL POR PROGRAMA INSTITUCIONAL</h4></td><td width="30" align="right"><h4>';
			 $html=$html.$toprograma1000;
			 $html=$html.'</h4></td><td width="35" align="right"><h4>';
			 $html=$html.$toprograma2000;
			 $html=$html.'</h4></td><td width="35" align="right"></td><td width="35" align="right"><h4>';
			 $html=$html.$toprograma3000;
			 $html=$html.'</h4></td><td width="35" align="right"></td><td width="30" align="right"><h4>';
			 $html=$html.$toprograma4000;
			 $html=$html.'</h4></td><td width="30" align="right"><h4>';
			 $html=$html.$toprograma5000;
			 $html=$html.'</h4></td><td width="43" align="right"><h4>';
			 $html=$html.$totalprograpro;
			 $html=$html.'</h4></td><td width="43" align="right"></td><td width="42" align="right"><h4>';
			 $html=$html.$totalprograpro;
			 $html=$html.'</h4></td></tr>';
$total1=$total1+$toprograma1000;
$total2=$total2+$toprograma2000;
$total3=$total3+$toprograma3000;
$total4=$total4+$toprograma4000;
$total5=$total5+$toprograma5000;
$totalt=$totalt+$totalprograpro;		 

$html=$html.'</table>';
 $html=$html.'<tr><td></td></tr>';

$html=$html.'<table border="1" align="center">';

$html=$html.'<tr>
	<td rowspan="3" width="70">Proyecto</td>
	<td rowspan="3" width="60">Indicador</td>
	<td rowspan="3" width="50">Formula</td>
	<td rowspan="3" width="40">Cantidad</td>
	<td rowspan="3" width="60">Acciones</td>
	<td colspan="7" width="230">Monto de recursos por Capitulo de Gasto</td>
	<td rowspan="2" colspan="2">Presupuesto a cubrir a travez de</td>
	<td rowspan="3">Total Presupuesto</td>
</tr>

<tr>
<td width="30">1000</td>
<td colspan="2" width="70">2000</td>
<td colspan="2" width="70">3000</td>
<td width="30">4000</td>
<td width="30">5000</td>
</tr>

<tr>
<td>Ingreso propio</td>
<td>Ingreso propio</td>
<td>Gasto directo</td>
<td>Ingreso propio</td>
<td>Gasto directo</td>
<td>Ingreso propio</td>
<td>Ingreso propio</td>
<td>Ingreso propio</td>
<td>Gasto directo</td>
</tr>';

$html=$html.'<tr bgcolor="#D9DAD9"><td width="280" align="right"><h3>GRAN TOTAL</h3></td><td width="30" align="right"><h3>';
$html=$html.$total1;
$html=$html.'</h3></td><td width="35" align="right"><h3>';
$html=$html.$total2;
$html=$html.'</h3></td><td width="35" align="right"></td><td width="35" align="right"><h3>';
$html=$html.$total3;
$html=$html.'</h3></td><td width="35" align="right"></td><td width="30" align="right"><h3>';
$html=$html.$total4;
$html=$html.'</h3></td><td width="30" align="right"><h3>';
$html=$html.$total5;
$html=$html.'</h3></td><td width="43" align="right"><h3>';
$html=$html.$totalt;
$html=$html.'</h3></td><td width="43" align="right"></td><td width="42" align="right"><h3>';
$html=$html.$totalt;
$html=$html.'</h3></td></tr>';
			    			 
$html=$html.'</table>';
$html=$html.'</table>';
 }
  else
{
  $html=$html.'<h2 align="center">LO SENTIMOS NO HAY DATOS</h2>';
} 
	



// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();



$pdf->Output('Reporte Institucional.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>