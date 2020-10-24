<?php


require_once('tcpdf_include.php');

require_once('../../conec.php');
$obj=new conect;
  if($obj->conectar()== TRUE)
  {

    $id=$_POST['id'];
  session_start();
  $periodo=$_SESSION['id_periodo'];  
  if(isset($_SESSION['usuario'])and $_SESSION['estado'] == 'autenticado' and $_SESSION['tipo_usuario']=='1')
  {

$uno="select *from proceso_clave where id_proceso_clave='$id'";
$dos=mysql_query($uno);
$row = mysql_fetch_array($dos);

$obje="SELECT * FROM proceso_clave,proceso_estrategico,objetivos where id_proceso_clave='$id' and proceso_clave.id_proceso_estrategico=proceso_estrategico.id_proceso_estrategico and proceso_estrategico.id_objetivos=objetivos.id_objetivos";
$obje2=mysql_query($obje);
$obje3 = mysql_fetch_array($obje2);

$prog="SELECT * FROM proceso_estrategico,proceso_clave WHERE id_proceso_clave='$id'";
$prog2=mysql_query($prog);
$row2=mysql_fetch_array($prog2);



//SACAR LAS LINEAS DE ACCION
$uno1="SELECT DISTINCT clave_lineas_accion,lineas_accion FROM `indicadores_proyecto`,`lineas_accion`, `lineas_accion_indicadores_proyecto` WHERE id_proceso_clave='$id' and indicadores_proyecto.id_indicadores_proyecto= lineas_accion_indicadores_proyecto.id_indicadores_proyecto and lineas_accion.id_lineas_accion=lineas_accion_indicadores_proyecto.id_lineas_accion";
$dos1=mysql_query($uno1);


// SACAR LOS INDICADORES
$indicador="select *from formula_apoa,indicadores_proyecto,formula_indicador_proyecto,periodicidad_indicador where id_proyecto='$id' and id_periodo='$periodo' and formula_apoa.id_indicador=indicadores_proyecto.id_indicadores_proyecto and indicadores_proyecto.id_formula_indicador_proyecto=formula_indicador_proyecto.id_formula_indicador_proyecto and formula_indicador_proyecto.id_periodicidad_indicador=periodicidad_indicador.id_periodicidad_indicador"; 
$indicador2=mysql_query($indicador);


// SACAR LAS LINEAS AUTORIZADAS
 $query1="select *from lineas_autorizadas where id_proyecto='$id' and id_periodo=$periodo";
 $res1=mysql_query($query1);

      
  

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
    $this->Cell(0, 15, 'TECNOLOGICO NACIOAL DE MEXICO', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(4);
    $this->SetFont('helvetica', 'B',7);
    $this->Cell(0, 15, '                                                          SECRETARIA DE PLANEACION, EVALUACION Y DESARROLLO INSTITUCINAL', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(4);
    $this->Cell(0, 15, '                                                           DIRECCION DE EVALUACION Y PLANEACION', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(4);
    $this->Cell(0, 15, '                                                           PROGRAMA INSTITUCIONAL ANUAL'.' '. $fecha, 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
$pdf->SetTitle('Reporte de Solicitud');
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

$pdf->AddPage();
// SACAR EL PROYECTO,PROGRAMA, OBJETIVO

$pdf->SetFont('helvetica', 'I', 8);



      $html=$html.'<div align="center"><table width="950" >';  
      
      // PROYECTO,PROGRAMA Y OBJETIVOS
     
        $html = $html.'<tr bgcolor="#C8C8C8" ><td  align="left" width="150" >'.'<b>'."PROYECTO:".'</b>'.'</td><td align="left">'.$row["id_proceso_clave"].'.'.$row["proceso_clave"].'</td></tr>';
        $html = $html.'<tr><td align="left">'."PROGRAMA:".'</td><td align="left">'.$row2["id_proceso_estrategico"].$row2["proceso_estrategico"].'</td></tr>';
        $html = $html.'<tr><td align="left">'."OBJETIVOS:".'</td><td align="left">'.$obje3["id_objetivos"].$obje3["objetivos"].'</td></tr>';
        
      
  



      //LINEAS DE ACCION
       $html=$html.'<tr><td width="150" align="left" >'."LINEAS ACCION".'</td><td align="justify">'; 
      while ($tres1=mysql_fetch_array($dos1)) {
        $html = $html.$tres1["clave_lineas_accion"].$tres1["lineas_accion"];
        $html=$html.'<br>';  
      }
      $html=$html.'</td></tr>'; 

      //INDICADORES

      $html=$html.'<tr bgcolor="#C8C8C8"><td  align="left" colspan="2">'.'<b>'."INDICADORES".'</b>'.'</td></tr>';

      while($row1=mysql_fetch_array($indicador2))
        {
                                  
            $html=$html.'<tr><td width="150" align="left">'."DESCRIPCION: ".'</td><td align="left">'.$row1["indicadores_proyecto"].'</td></tr>';
            $html=$html.'<tr><td align="left">'."FORMULA".'</td><td align="left">'.$row1["formula_indicador_proyecto"].'</td></tr>';
            $html=$html.'<tr><td align="left">'."PERIODICIDAD".'</td><td align="left">'.$row1["periodicidad_indicador"].'</td></tr>';
            $html=$html.'<tr><td align="left">'."CANTIDAD".'</td><td align="left">'.$row1["cantidad"].'</td></tr>';

        }

       //LINEAS AUTORIZADAS
       
       $html=$html.'<tr bgcolor="#C8C8C8"><td  align="left" colspan="2">'.'<b>'."ACCIONES".'</b>'.'</td></tr>';

        while($row3=mysql_fetch_array($res1))
            {
                                
                   $html=$html.'<tr><td align="left" colspan="2">'.$row3["clave_linea"].$row3["linea_accion"].'</td></tr>';

              }
                
                            
               
                            

      




      $html=$html.'</table></div>';

       



$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('Reporte usuarios.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>