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
  header('Content-Type: text/html; charset=iso-8859-1');
     

     $var="SELECT * FROM `_vw_reportecapitulo100` where id_periodo='$periodo'";
     $res=mysql_query($var);
      
    $compa=mysql_num_rows($res);
	mysql_query("SET NAME 'utf8'");
  if($compa>0)
  {

      $html=$html.'<table border="1">';  
  $html=$html.'<tr><td width="130" align="center">Proyecto</td><td width="80" align="center">Partida</td><td width="200" align="center">Descripcion Especifica del Pago</td><td width="150" align="center">Departamento</td><td width="80" align="center">Importe</td></tr>';
  $html=$html.'</table>';
   

      $row=mysql_fetch_array($res);
        $html=$html.'<table>';
        $html=$html.'<tr><td></td></tr>';      
        $html=$html.'<tr><td width="130">';
        $html=$html.$row["id_proyecto"].' '.$row["proceso_clave"];
        $html=$html.'</td><td width="80" align="center">';
        $html=$html.$row["id_partida"];
        $html=$html.'</td><td width="200">';
        $html=$html.$row["Descripcion_del_bien"];
        $html=$html.'</td><td width="150">';
        $html=$html.$row["Depto_Genera"];
        $html=$html.'</td><td width="80" align="center">';
        $html=$html.'$';
        $html=$html.$row["importe"];
        $html=$html.'</td></tr>';
        $html=$html.'<tr><td></td></tr>';
       $proyecto=$row["id_proyecto"];
           $partida=$row["id_partida"];
           $total=$total+$row["importe"];

           $totalgeneral="0";

           while ($row1=mysql_fetch_array($res))
          {

          if($row1["id_proyecto"]==$proyecto)
          {
                if($row1["id_partida"]==$partida)
                {

                   if($row1["Descripcion_del_bien"]==$row["Descripcion_del_bien"])
                    {
                      

                    }
                    else
                    {
                       $html=$html.'<tr><td width="130"></td><td width="80" align="center">';
                       $html=$html.$row1["id_partida"];
                       $html=$html.'</td><td width="200">';
                       $html=$html.$row1["Descripcion_del_bien"];
                       $html=$html.'</td><td width="150">';
                       $html=$html.$row1["Depto_Genera"];
                       $html=$html.'</td><td width="80" align="center">';
                       $html=$html.'$';
                       $html=$html.$row1["importe"];
                       $html=$html.'</td></tr>';
                       $total=$total+$row1["importe"];
                       $html=$html.'<tr><td></td></tr>';
                    }

                }
                else
                {
                   $html=$html.'<tr><td width="130">';
                   $html=$html.$row1["id_proyecto"].$row1["proceso_clave"];
                   $html=$html.'</td><td width="80" align="center">';
                   $html=$html.$row1["id_partida"];
                   $html=$html.'</td><td width="200">';
                   $html=$html.$row1["Descripcion_del_bien"];
                   $html=$html.'</td><td width="150">';
                   $html=$html.$row1["Depto_Genera"];
                   $html=$html.'</td><td width="80" align="center">';
                   $html=$html.'$';
                   $html=$html.$row1["importe"];
                   $html=$html.'</td></tr>';
                  $total=$total+$row1["importe"];


                }

                
          }
          else
          {
           $html=$html.'</table>';
            $html=$html.'<table border="1">';
          $html=$html.'<tr bgcolor="#D9DAD9"><td colspan="4" align="right" width="560">Total por Partida</td><td width="80" align="center">';
          $html=$html.'$';
          $html=$html.$total;
          $html=$html.'</td></tr>';
          $html=$html.'<tr><td colspan="4" align="right" width="560">Total por Proyecto</td><td width="80" align="center">';
          $html=$html.'$';
          $html=$html.$total;
          $html=$html.'</td></tr>';
          $html=$html.'</table>';
        

          $html=$html.'<table>';
          $totalgeneral=$totalgeneral+$total;
          $html=$html.'<tr><td></td></tr>';
          $html=$html.'<tr><td width="130"> ';
          $html=$html.$row1["id_proyecto"].$row1["proceso_clave"];
          $html=$html.'</td><td width="80" align="center">';
          $html=$html.$row1["id_partida"];
          $html=$html.'</td><td width="200">';
          $html=$html.$row1["Descripcion_del_bien"];
          $html=$html.'</td><td width="150">';
          $html=$html.$row1["Depto_Genera"];
          $html=$html.'</td><td width="80" align="center">';
          $html=$html.'$';
          $html=$html.$row1["importe"];
          $html=$html.'</td></tr>';
                
                $proyecto=$row1["id_proyecto"];
                $partida=$row1["id_partida"];
                
                $total="0";
                 $total=$total+$row1["importe"];
                 $html=$html.'<tr><td></td></tr>';
          
          
        
        
          }

          
        
        }
        
        $html=$html.'</table>';
        $totalgeneral=$totalgeneral+$total; 
         $html=$html.'<table border="1">';
         $html=$html.'<tr bgcolor="#D9DAD9"><td colspan="4" align="right" width="560">Total por Partida</td><td width="80"  align="center">';
         $html=$html.'$';
         $html=$html.$total;
         $html=$html.'</td></tr>';
         $html=$html.'<tr><td colspan="4" align="right" width="560">Total por Proyecto</td><td width="80"  align="center">';
         $html=$html.'$';
         $html=$html.$total;
         $html=$html.'</td></tr>';
         $html=$html.'</table>';
        
         $html=$html.'<table >';
         $html=$html.'<tr><td></td></tr>';
         $html=$html.'<tr><td colspan="4" align="right" width="560"><h3>Gran Total</h3></td><td width="80" align="center"><h3>';
         $html=$html.'$';
         $html=$html.$totalgeneral;
         $html=$html.'</h3></td></tr>';

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
    $this->Cell(0, 15, 'PROGRAMA INSTITUCIONAL ANUAL '.$fecha, 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(4);
    $this->Cell(0, 15, 'Desglose de Ingresos Propios Orientados al Pago del Capitulo 1000', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(3);
    $this->Cell(0, 15,'(Partidas Presupuestales de la 12101, 12301 Y 13404)', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
    $this->SetY(-35);
    // Set font
    $this->SetFont('helvetica', 'k', 6);
    // Page number
    $this->Cell(0, 15, 'Hago constar que el monto de partida 12101 considera el pago a personal externo del instituto o centro por servicios eventuales no mayores a 6 meses. El monto de la', 0, false, 'J', 0, '', 0, false, 'M', 'M');
    $this->Ln(3);
    $this->Cell(0, 15, 'partida 12301, considera el pago por servicios de caracter social (estadias, residencias y servicios social). El monto de la partida 13404 considera el pago a personal ', 0, false, 'J', 0, '', 0, false, 'M', 'M');
    $this->Ln(3);
    $this->Cell(0, 15, 'adscrito al instituto o centro por sinodalías, exámenes estraordinarios y profesionales, imparticion de cursos de verano, regularizacion y de más naturaleza similar.', 0, false, 'J', 0, '', 0, false, 'M', 'M');
    $this->Ln(3);
    $this->Cell(0, 15, 'Los montos descritos en ningun caso se destinaran al pago a docentes por imparticion de asignaturas curriculares durante el semestre.', 0, false, 'L', 0, '', 0, false, 'M', 'M');
    $this->Ln(5);
    $this->Cell(0, 15, '                Vo. Bo. DIRECTOR DEL I.T.', 0, false, 'L', 0, '', 0, false, 'M', 'M');
    $this->Ln(4);
    $this->Cell(0, 15, '_______________________________________', 0, false, 'L', 0, '', 0, false, 'M', 'M');
    $this->Ln(4);
    $this->Cell(0, 15,''.$per1['titulo_abreviado'].' '.$per1['Nombre'].$per1['Apellidos'], 0, false, 'L', 0, '', 0, false, 'M', 'M');
    $this->Ln(4);
    $this->Cell(0, 15,'                 Director del IT o Centro', 0, false, 'L', 0, '', 0, false, 'M', 'M');
   
    $this->Cell(0, 10, 'Pagina ' .$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
  }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('reporte 1000 Institucional');
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

ob_end_clean();

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();



$pdf->Output('Reporte usuarios.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>