<?php


require_once('tcpdf_include.php');

require_once('../../conec.php');


$obj=new conect;
  if($obj->conectar()== TRUE)
  {

  session_start();
  $periodo=$_SESSION['id_periodo']; 
  $depa=$_SESSION['departamento']; 
  if(isset($_SESSION['usuario'])and $_SESSION['estado'] == 'autenticado' )
  {
  
     $var="SELECT *from (select @id_depapogram := '$depa' i)alias,reporteporprogramaypro_depa where id_periodo='$periodo' order by id_proyecto";
      $res=mysql_query($var);

      $compa=mysql_num_rows($res);
  if($compa>0)
  {

     $html=$html.'<table  border="1">';
        $html=$html.'<tr><td rowspan="2" width="150" align="center">Programa Intitucional</td><td rowspan="2" width="250" align="center">Proyecto</td><td colspan="2" width="140" align="center">Presupuestos a Cubrir a Traves de</td><td rowspan="2" width="100" align="center">Presupuesto Total</td></tr>';
        $html=$html.'<tr><td width="70" align="center">Ingresos Propios</td><td width="70" align="center">Gastos Directos</td></tr>';
        
        $html=$html.'</table>';
        //if($row = mysql_fetch_array($res))
      $row = mysql_fetch_array($res);
      $total="0";

         $html=$html.'<table>';
          $html=$html.'<tr><td></td></tr>';          
            $html=$html.'<tr><td width="150">';
            $html=$html.$row["id_programa"].$row["proceso_estrategico"];
            $html=$html.'</td><td width="250">';
            $html=$html.$row["id_proyecto"].$row["proceso_clave"];
            $html=$html.'</td><td width="70" align="center">';
            $html=$html.$row["total"];
            $html=$html.'</td><td width="70"></td><td width="100" align="center">';
            $html=$html.$row["total"];
            $html=$html.'</td></tr>';

           $programa=$row["id_programa"];
           $proyecto=$row["id_proyecto"];
           $total=$total+$row["total"];

          while ($row1=mysql_fetch_array($res))
          {

          if($row1["id_programa"]==$programa)
          {
                if($row1["id_proyecto"]==$proyecto)
                {
                  

                }
                else
                {
                   $html=$html.'<tr><td width="150"></td><td width="250">';
                    $html=$html.$row1["id_proyecto"].$row1["proceso_clave"];
                     $html=$html.'</td><td width="70" align="center">';
                      $html=$html.$row1["total"];
                       $html=$html.'</td><td width="70"></td><td width="100" align="center">';
                        $html=$html.$row1["total"];
                         $html=$html.'</td></tr>';
                   $total=$total+$row1["total"];
                   $html=$html.'<tr><td></td></tr>';

                }
              
                
          }
          else
          {
              $html=$html.'<tr><td></td></tr>';
             $html=$html.'</table>';

              $html=$html.'<table  border="1">';
          
           $html=$html.'<tr bgcolor="#D9DAD9"><td colspan="2" align="right" width="400">TOTAL PROGRAMA</td><td width="70" align="center">';
            $html=$html.$total;
            $html=$html.'</td><td width="70"></td><td width="100" align="center">';
             $html=$html.$total;
              $html=$html.'</td></tr>';
              $html=$html.'</table>';
              $grantotal=$grantotal+$total;
          
          $total="0";
           $html=$html.'<table >';
           $html=$html.'<tr><td></td></tr>';
                 $html=$html.'<tr><td width="150">';
                  $html=$html.$row1["id_programa"].$row1["proceso_estrategico"];
                   $html=$html.'</td><td width="250">';
                    $html=$html.$row1["id_proyecto"].$row1["proceso_clave"];
                     $html=$html.'</td><td width="70" align="center">';
                      $html=$html.$row1["total"];
                       $html=$html.'</td><td width="70"></td><td width="100" align="center">';
                        $html=$html.$row1["total"];
                         $html=$html.'</td></tr>';
                $programa=$row1["id_programa"];
          $proyecto=$row1["id_proyecto"];
          $total=$total+$row1["total"];
          $html=$html.'<tr><td></td></tr>';
          
          
          
        
           
  
      
          
          }



          
        
        }
        $html=$html.'<table border="1">';

          $html=$html.'<tr bgcolor="#D9DAD9"><td colspan="2" align="right" width="400">TOTAL PROGRAMA</td><td width="70" align="center">';
            $html=$html.$total;
             $html=$html.'</td><td width="70"></td><td width="100" align="center">';
              $html=$html.$total;
               $html=$html.'</td></tr>';
           $html=$html.'</table>';
           $grantotal=$grantotal+$total;

            $html=$html.'<tr><td></td></tr>';
        $html=$html.'<table >';
        $html=$html.'<tr><td></td></tr>';
          $html=$html.'<tr><td colspan="2" align="right" width="400"><h2>GRAN TOTAL</h2></td><td width="70" align="center"><h2>';
            $html=$html.$grantotal;
             $html=$html.'</h2></td><td width="70"></td><td width="100" align="center"><h2>';
              $html=$html.$grantotal;
               $html=$html.'</h2></td></tr>';
           $html=$html.'</table>';
        
     
  }
  else
{
  $html=$html.'<h2 align="center">LO SENTIMOS ESTE DEPARTAMENTO NO TIENE DATOS</h2>';
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
    $this->Cell(0, 15, 'PROGRAMA INSTITUCIONAL ANUAL '.$fecha, 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(4);
    $this->Cell(0, 15, 'Concentrador Por Programa y Proyecto Institucional', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(6);
   
    
     $this->SetFont('helvetica', 'B',6);
$this->Cell(0, 20, ''.$escu2['Institucion'], 0, false, 'L', 0, '', 0, false, 'M', 'M');
$this->Ln(1);

  }

  // Page footer
  public function Footer() {
   
    // Position at 15 mm from bottom
    $this->SetY(-15);
    // Set font
    $this->SetFont('helvetica', 'k', 6);
    // Page number
   
   
    $this->Cell(0, 10, 'Pagina ' .$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
  }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Reporte por Programa y Proyecto Departamental');
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