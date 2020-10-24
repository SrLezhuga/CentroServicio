<?php


require_once('tcpdf_include.php');

require_once('../../conec.php');


$obj=new conect;
  if($obj->conectar()== TRUE)
  {

  session_start();
  $periodo=$_SESSION['id_periodo'];
   $depa=$_SESSION['departamento'];    
  if(isset($_SESSION['usuario'])and $_SESSION['estado'] == 'autenticado')
  {
  
     

     $var="SELECT *from (select @id_depacap500 := '$depa' i)alias, _vw_cap5000_depa where id_periodo='$periodo'";
      $res=mysql_query($var);

        $compa=mysql_num_rows($res);
  if($compa>0)
  {
      

      $html=$html.'<table border="1">';  
      $html=$html.'<tr><td width="100" align="center">Proyecto</td><td width="50" align="center">Partida Pptal</td><td width="180" align="center">Denominacion del bien</td><td width="40" align="center">Cantidad</td><td width="40" align="center">Costo Unitario</td><td width="50" align="center">Costo Total</td><td width="180" align="center">Justificacion</td></tr>';
      $html=$html.'</table>';

      $row=mysql_fetch_array($res);
      
      $html=$html.'<table>';
      $html=$html.'<tr><td width="640"></td></tr>';    
       $html=$html.'<tr><td width="640"><h4>';
       $html=$html.$row["id_programa"].$row["proceso_estrategico"];
       $html=$html.'</h4></td></tr>';
       $html=$html.'<tr><td width="640"></td></tr>'; 
       $html=$html.'<tr><td width="100" align="center">';
       $html=$html.$row["id_proyecto"].$row["proceso_clave"];
       $html=$html.'</td><td width="50" align="center">';
       $html=$html.$row["id_partida"];
       $html=$html.'</td><td width="180">';
       $html=$html.$row["Denominacion_bien"];
       $html=$html.'</td><td width="40" align="center">';
       $html=$html.$row["cantidadtotal"];
       $html=$html.'</td><td width="40" align="center">';
       $html=$html.$row["totalim"];
       $html=$html.'</td><td width="50" align="center">';
       $html=$html.$row["importe"];
       $html=$html.'</td><td width="180">';
       $html=$html.$row["Justificacion"];
       $html=$html.'</td></tr>';
       $programa=$row["id_programa"];
       $proyecto=$row["id_proyecto"];
       $partida=$row["id_partida"];
       $bien=$row["Denominacion_bien"];
       $total=$total+$row["importe"];
       
       
        while ($row1=mysql_fetch_array($res))
          {

          if($row1["id_programa"]==$programa)
          {
              if($row1["id_proyecto"]==$proyecto)
              {
                if($row1["id_partida"]==$partida)
                {

                   if($row1["Denominacion_bien"]==$row["Denominacion_bien"])
                    {
                      

                    }
                    else
                    {
                      $html=$html.'<tr><td width="100"></td><td width="50" align="center">';
                      $html=$html.$row1["id_partida"];
                      $html=$html.'</td><td width="180">';
                      $html=$html.$row1["Denominacion_bien"];
                      $html=$html.'</td><td width="40" align="center">';
                      $html=$html.$row1["cantidadtotal"];
                      $html=$html.'</td><td width="40" align="center">';
                      $html=$html.$row1["totalim"];
                      $html=$html.'</td><td width="50" align="center">';
                      $html=$html.$row1["importe"];
                      $html=$html.'</td><td width="180">';
                      $html=$html.$row1["Justificacion"];
                      $html=$html.'</td></tr>';
                      $total=$total+$row1["importe"];
                      

                                    

                    }

                }
                else
                {
                  $html=$html.'<tr><td width="640"></td></tr>'; 
                  $html=$html.'</table>';
                  $html=$html.'<table border="1">';
                  $html=$html.'<tr bgcolor="#D9DAD9"><td colspan="3" width="410" align="right">TOTAL POR PARTIDA</td><td width="50" align="center">';
                  $html=$html.$total;
                  $html=$html.'</td><td width="180"></td></tr>';
                  $html=$html.'</table>';
                  $html=$html.'<table>';
                  $html=$html.'<tr><td width="640"></td></tr>'; 
                  $totalproyecto=$totalproyecto+$total;
                  

                  $total="0";
                  
                  $html=$html.'<tr><td width="100" align="center">';
                  $html=$html.$row1["id_proyecto"].$row1["proceso_clave"];
                  $html=$html.'</td><td width="50" align="center">';
                  $html=$html.$row1["id_partida"];
                  $html=$html.'</td><td width="180">';
                  $html=$html.$row1["Denominacion_bien"];
                  $html=$html.'</td><td width="40" align="center">';
                  $html=$html.$row1["cantidadtotal"];
                  $html=$html.'</td><td width="40" align="center">';
                  $html=$html.$row1["totalim"];
                  $html=$html.'</td><td width="50" align="center">';
                  $html=$html.$row1["importe"];
                  $html=$html.'</td><td width="180">';
                  $html=$html.$row1["Justificacion"];
                  $html=$html.'</td></tr>';
                  $proyecto=$row1["id_proyecto"];
                  $partida=$row1["id_partida"];
                  $total=$total+$row1["importe"];
                  
                  //$totalgeneral=$totalgeneral+$total;
                  
               
                  }

                          
                }
              
              else
              {

              }
                
          }
          else
          {

          $html=$html.'<tr><td width="640"></td></tr>'; 
          $html=$html.'</table>';
          $html=$html.'<table border="1">';
          $html=$html.'<tr bgcolor="#D9DAD9"><td colspan="3" width="410" align="right">TOTAL POR PARTIDA</td><td width="50" align="center">';
          $html=$html.$total;
          $html=$html.'</td><td width="180"></td></tr>';
          $totalproyecto=$totalproyecto+$total;

          $html=$html.'<tr><td colspan="3" width="410" align="right"><h3>TOTAL POR PROYECTO</h3></td><td width="50" align="center"><h3>';
          $html=$html.$totalproyecto;
          $html=$html.'</h3></td><td width="180"></td></tr>';
          $html=$html.'</table>';
          $html=$html.'<table >';          
          $totalgeneral=$totalgeneral+$totalproyecto;

          $totalproyecto="0"; 
          $total="0";
          
          $html=$html.'<tr><td width="640"></td></tr>'; 
          $html=$html.'<tr><td width="640"><b>';
          $html=$html.$row1["id_programa"].$row1["proceso_estrategico"];
          $html=$html.'</b></td></tr>';
          $html=$html.'<tr><td width="640"></td></tr>'; 
          $html=$html.'<tr><td width="100" align="center">';
          $html=$html.$row1["id_proyecto"].$row1["proceso_clave"];
          $html=$html.'</td><td width="50" align="center">';
          $html=$html.$row1["id_partida"];
          $html=$html.'</td><td width="180">';
          $html=$html.$row1["Denominacion_bien"];
          $html=$html.'</td><td width="40" align="center">';
          $html=$html.$row1["cantidadtotal"];
          $html=$html.'</td><td width="40" align="center">';
          $html=$html.$row1["totalim"];
          $html=$html.'</td><td width="50" align="center">';
          $html=$html.$row1["importe"];
          $html=$html.'</td><td width="180">';
          $html=$html.$row1["Justificacion"];
          $html=$html.'</td></tr>'; 
             
          $programa=$row1["id_programa"];
          $proyecto=$row1["id_proyecto"];
          $partida=$row1["id_partida"];
          $bien=$row1["Denominacion_bien"];
          $total=$total+$row1["importe"];
          $html=$html.'<tr><td></td></tr>';
          
          
          
        
        
          }

          
        
        }
        
        
        $html=$html.'<tr><td width="640"></td></tr>'; 
        $html=$html.'</table>';
        $html=$html.'<table border="1">';
        $html=$html.'<tr bgcolor="#D9DAD9"><td colspan="4" width="410" align="right">TOTAL POR PARTIDA</td><td width="50" align="center">';
        $html=$html.$total;
        $totalproyecto=$totalproyecto+$total;
        $html=$html.'</td><td width="180"></td></tr>';
        $html=$html.'<tr><td colspan="3" width="410" align="right"><h3>TOTAL POR PROYECTO</h3></td><td width="50" align="center"><h3>';
        $html=$html.$totalproyecto;
        $html=$html.'</h3></td><td width="180"></td></tr>';
        $html=$html.'</table>';
        $html=$html.'<tr><td width="640"></td></tr>'; 
        $html=$html.'<tr><td width="640"></td></tr>';
        $totalgeneral=$totalgeneral+$totalproyecto;

        $html=$html.'<table >';
        $html=$html.'<tr><td colspan="4" width="410" align="right"><h2>GRAN TOTAL</h2></td><td width="50" align="center"><h2>';
        $html=$html.$totalgeneral;
        $html=$html.'</h2></td><td width="180"></td></tr>';

        $html=$html.'</table>';

  }
  else
{
  $html=$html.'<h2 align="center">LO SENTIMOS NO HAY DATOS</h2>';
} 
 
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
    $escu="SELECT * FROM `instituciones` LIMIT 1";
      $escu1=mysql_query($escu);
      $escu2=mysql_fetch_array($escu1);
	  
	   $peri="select *from periodos where id_periodo='$_SESSION[id_periodo]'";
		 $peri1=mysql_query($peri);
		 $peri2=mysql_fetch_array($peri1);
	     $fecha=substr($peri2['fecha_inicio'],0,4);
    // Logo
    $image_file = K_PATH_IMAGES.'sep.PNG';
    $this->Image($image_file, 15, 4, 35, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    // Set font
    $this->SetFont('helvetica', 'B',7);
    $this->Cell(0, 15,'', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(3);
    $this->Cell(0, 15,'TECNOLOGICO NACIONAL DE MEXICO', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(4);
    $this->SetFont('helvetica', 'B',7);
    $this->Cell(0, 15, 'PROGRAMA INSTITUCIONAL ANUAL '. $fecha, 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(4);
    $this->Cell(0, 15, 'Desglose del Presupuesto de Inversion con Cargo a Ingresos Propios', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(3);
    $this->Cell(0, 15,'(CAPITULO 5000)', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(4);
    
     $this->SetFont('helvetica', 'B',6);
$this->Cell(0, 20, ''.$escu2['Institucion'], 0, false, 'L', 0, '', 0, false, 'M', 'M');
$this->Ln(1);

  }

  // Page footer
  public function Footer() {
    $personal="SELECT * FROM personal where id_Puesto='1'";
      $per=mysql_query($personal);
      $per1=mysql_fetch_array($per);
    // Position at 15 mm from bottom
    $this->SetY(-25);
    // Set font
    $this->SetFont('helvetica', 'k', 6);
    // Page number
    
    $this->Cell(0, 15, '                Vo. Bo. DIRECTOR DEL I.T.', 0, false, 'L', 0, '', 0, false, 'M', 'M');
    $this->Ln(4);
    $this->Cell(0, 15, '_______________________________________', 0, false, 'L', 0, '', 0, false, 'M', 'M');
    $this->Ln(4);
    $this->Cell(0, 15,'NOMBRE: '.$per1['titulo_abreviado'].' '.$per1['Nombre'].$per1['Apellidos'], 0, false, 'L', 0, '', 0, false, 'M', 'M');
    $this->Ln(4);
    $this->Cell(0, 15,'                 RFC:  '.$per1['RFC'], 0, false, 'L', 0, '', 0, false, 'M', 'M');
   
    $this->Cell(0, 10, 'Pagina ' .$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
  }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Reporte capitulo 5000 Departamental');
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

$pdf->SetFont('helvetica', '',6, '', true);
$pdf->AddPage('L', 'A5');

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();



$pdf->Output('Reporte departamento.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>