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
  
     $var="SELECT * FROM `_vw_partidas` where id_periodo='$periodo' order by id_capitulo,id_partida";
      $res=mysql_query($var);

      $compa=mysql_num_rows($res);
  if($compa>0)
  {

       $html=$html.'<table border="1" align="center" width="100%">
    <tr>
      <td rowspan="3" width="35">Partida Pptal</td>
      <td colspan="18">Programas Institucionales</td>
      <td rowspan="2" colspan="2">Presupuesto a cubrir a travez de</td>
      <td rowspan="3">Total</td>
        </tr>
    <tr>
      <td colspan="2">Fortalecimiento del DesarrolloProfecionak Docente</td>
      <td colspan="2">Fortalecimiento de la calida educativa</td>
      <td colspan="2">Aprobechamiento de las TIC en el proceso educativo</td>
      <td colspan="2">Covertura Permanencia y equidad educativa</td>
      
      <td colspan="2">Programa de Formacion Integral</td>
      
      <td colspan="2">Impulso a la Investigacion Cientifica y Desarrollo Tecnologico</td>
      
      <td colspan="2">Vinculacion Para la Inovacion e Internacionalizacion</td>
      <td colspan="2">Educaion para la vida Bilingüe</td>
      <td colspan="2">Gestion Institucional </td>
    </tr>
    <tr>
      <td>Ingresos Propios</td>
      <td>Gasto Directo</td>
      <td>Ingresos Propios</td>
      <td>Gasto Directo</td>
      <td>Ingresos Propios</td>
      <td>Gasto Directo</td>
      <td>Ingresos Propios</td>
      <td>Gasto Directo</td>
      <td>Ingresos Propios</td>
      <td>Gasto Directo</td>
      <td>Ingresos Propios</td>
      <td>Gasto Directo</td>
      <td>Ingresos Propios</td>
      <td>Gasto Directo</td>
      <td>Ingresos Propios</td>
      <td>Gasto Directo</td>
      <td>Ingresos Propios</td>
      <td>Gasto Directo</td>
      <td>Ingresos Propios</td>
      <td>Gasto Directo</td>    
    </tr>
    
  </table>';
      

  $prog1="0";$prog2="0";$prog3="0";$prog4="0";$prog5="0";$prog6="0";$prog7="0";$prog8="0";$prog9="0";$prog10="0";$prog11="0";
  $total1='0';$total2='0';$total3='0';$total4='0';$total5='0';$total6='0';$total7='0';$total8='0';$total9='0';      
  $suma="0";    

   $html=$html.'<table border="1">';
  

      $row=mysql_fetch_array($res);

     //$html=$html.'<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
       


        $html=$html.'<tr><td width="35" align="center">';
        $html=$html.$row["id_partida"];
        $html=$html.'</td><td align="right">';
        $html=$html.$row["programa"];

        $html=$html.'</td><td></td><td align="right">';
        $html=$html.$row["programa2"];
        $html=$html.'</td><td></td><td align="right">'; 
        $html=$html.$row["programa3"];
        $html=$html.'</td><td></td><td align="right">'; 
        $html=$html.$row["programa4"];
        $html=$html.'</td><td></td><td align="right">';
        $html=$html.$row["programa5"]; 
        $html=$html.'</td><td></td><td align="right">'; 
        $html=$html.$row["programa6"]; 
        $html=$html.'</td><td></td><td align="right">'; 
        $html=$html.$row["programa7"]; 
        $html=$html.'</td><td></td><td align="right">'; 
        $html=$html.$row["programa8"]; 
        $html=$html.'</td><td></td><td align="right">'; 
        $html=$html.$row["programa9"];
        $html=$html.'</td><td></td><td align="right">';
        $html=$html.$row["cantidadtotal"];
        $html=$html.'</td><td></td><td align="right">';
        $html=$html.$row["cantidadtotal"];
        $html=$html.'</td></tr>';

           $capitulo=$row['id_capitulo'];
           $partida=$row['id_partida'];
           $prog1=$prog1+$row['programa'];$prog2=$prog2+$row['programa2'];$prog3=$prog3+$row['programa3'];
           $prog4=$prog4+$row['programa4'];$prog5=$prog5+$row['programa5'];$prog6=$prog6+$row['programa6'];
           $prog7=$prog7+$row['programa7'];$prog8=$prog8+$row['programa8'];$prog9=$prog9+$row['programa9'];
           $prog10="0";$prog11="0";
           $suma=$prog1+$prog2+$prog3+$prog4+$prog5+$prog6+$prog7+$prog8+$prog9;
         

           //$total=$total+$row["importe"];
           while ($row1=mysql_fetch_array($res))
          {

          if($row1['id_capitulo']==$capitulo) 
          {

              if($row1['id_partida']==$partida)       
                {
                                            
                }
                else
                {
              




              $html=$html.'<tr><td align="center">';
              $html=$html.$row1["id_partida"];
              $html=$html.'</td><td align="right">';
              $html=$html.$row1["programa"];
              $html=$html.'</td><td></td><td align="right">';
              $html=$html.$row1["programa2"];
              $html=$html.'</td><td></td><td align="right">';
              $html=$html.$row1["programa3"];
              $html=$html.'</td><td></td><td align="right">';
              $html=$html.$row1["programa4"];
              $html=$html.'</td><td></td><td align="right">';
              $html=$html.$row1["programa5"];
              $html=$html.'</td><td></td><td align="right">';
              $html=$html.$row1["programa6"];
              $html=$html.'</td><td></td><td align="right">';
              $html=$html.$row1["programa7"];
              $html=$html.'</td><td></td><td align="right">';
              $html=$html.$row1["programa8"];
              $html=$html.'</td><td></td><td align="right">';
              $html=$html.$row1["programa9"];
              $html=$html.'</td><td></td><td align="right">';
              $html=$html.$row1["cantidadtotal"];
              $html=$html.'</td><td></td><td align="right">';
              $html=$html.$row1["cantidadtotal"];
              $html=$html.'</td></tr>';
               $prog1=$prog1+$row1['programa'];$prog2=$prog2+$row1['programa2'];$prog3=$prog3+$row1['programa3'];
           $prog4=$prog4+$row1['programa4'];$prog5=$prog5+$row1['programa5'];$prog6=$prog6+$row1['programa6'];
           $prog7=$prog7+$row1['programa7'];$prog8=$prog8+$row1['programa8'];$prog9=$prog9+$row1['programa9'];
           $suma=$prog1+$prog2+$prog3+$prog4+$prog5+$prog6+$prog7+$prog8+$prog9;
              
                }
          }
          else
          {
            $html=$html.'<tr bgcolor="#D9DAD9"><td>Total';
            $html=$html.$capitulo;
            $html=$html.'</td><td align="right">';
            $html=$html.$prog1;
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$prog2;
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$prog3;
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$prog4;
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$prog5;
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$prog6;
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$prog7;
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$prog8;
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$prog9;
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$suma;
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$suma;
            $html=$html.'</td></tr>';
          $total1=$total1+$prog1;$total2=$total2+$prog2;$total3=$total3+$prog3;$total4=$total4+$prog4;
          $total5=$total5+$prog5;$total6=$total6+$prog6;$total7=$total7+$prog7;$total8=$total8+$prog8;$total9=$total9+$prog9;
        
            $html=$html.'<tr><td align="center">';
            $html=$html.$row1["id_partida"];
            $html=$html.'</td><td align="right">';
            $html=$html.$row1["programa"];
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$row1["programa2"];
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$row1["programa3"];
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$row1["programa4"];
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$row1["programa5"];
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$row1["programa6"];
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$row1["programa7"];
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$row1["programa8"];
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$row1["programa9"];
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$row1["cantidadtotal"];
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$row1["cantidadtotal"];
            $html=$html.'</td></tr>';

                $partida=$row1['id_partida'];
                $capitulo=$row1['id_capitulo'];
              $prog1="0";$prog2="0";$prog3="0";$prog4="0";$prog5="0";$prog6="0";$prog7="0";$prog8="0";$prog9="0";$prog10="0";$prog11="0";
           

               $prog1=$prog1+$row1['programa'];$prog2=$prog2+$row1['programa2'];$prog3=$prog3+$row1['programa3'];
           $prog4=$prog4+$row1['programa4'];$prog5=$prog5+$row1['programa5'];$prog6=$prog6+$row1['programa6'];
           $prog7=$prog7+$row1['programa7'];$prog8=$prog8+$row1['programa8'];$prog9=$prog9+$row1['programa9'];

          } 
        $suma=$prog1+$prog2+$prog3+$prog4+$prog5+$prog6+$prog7+$prog8+$prog9;

        }
        
        $html=$html.'<tr bgcolor="#D9DAD9"><td >Total'; 
        $html=$html.$capitulo;
        $html=$html.'</td><td align="right">';
        $html=$html.$prog1;
        $html=$html.'</td><td></td><td align="right">';
        $html=$html.$prog2;
        $html=$html.'</td><td></td><td align="right">';
        $html=$html.$prog3;
        $html=$html.'</td><td></td><td align="right">';
        $html=$html.$prog4;
        $html=$html.'</td><td></td><td align="right">';
        $html=$html.$prog5;
        $html=$html.'</td><td></td><td align="right">';
        $html=$html.$prog6;
        $html=$html.'</td><td></td><td align="right">';
        $html=$html.$prog7;
        $html=$html.'</td><td></td><td align="right">';
        $html=$html.$prog8;
        $html=$html.'</td><td></td><td align="right">';
        $html=$html.$prog9;
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$suma;
            $html=$html.'</td><td></td><td align="right">';
            $html=$html.$suma;
            $html=$html.'</td></tr>';
        $total1=$total1+$prog1;$total2=$total2+$prog2;$total3=$total3+$prog3;$total4=$total4+$prog4;
        $total5=$total5+$prog5;$total6=$total6+$prog6;$total7=$total7+$prog7;$total8=$total8+$prog8;$total9=$total9+$prog9;
        $tot=$total1+$total2+$total3+$total4+$total5+$total6+$total7+$total8+$total9;
        
        $html=$html.'<tr><td><h4>Total PROG</h4></td><td align="right">';
        $html=$html.$total1;
        $html=$html.'</td><td></td><td align="right"><h4>';
        $html=$html.$total2;
        $html=$html.'</h4></td><td></td><td align="right"><h4>';
        $html=$html.$total3;
        $html=$html.'</h4></td><td></td><td align="right"><h4>';
        $html=$html.$total4;
        $html=$html.'</h4></td><td></td><td align="right"><h4>';
        $html=$html.$total5;
        $html=$html.'</h4></td><td></td><td align="right"><h4>';
        $html=$html.$total6;
        $html=$html.'</h4></td><td></td><td align="right"><h4>';
        $html=$html.$total7;
        $html=$html.'</h4></td><td></td><td align="right"><h4>';
        $html=$html.$total8;
        $html=$html.'</h4></td><td></td><td align="right"><h4>';
        $html=$html.$total9;
        $html=$html.'</h4></td><td></td><td align="right"><h4>';
        $html=$html.$tot;
        $html=$html.'</h4></td><td></td><td align="right"><h4>';
        $html=$html.$tot;
        $html=$html.'</h4></td></tr>';

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
    $this->Cell(0, 15, 'Conceptrado Por Partida Presupuestal y Programa Institucional', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(6);
    
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
$pdf->SetTitle('reporte por Partida Institucional');
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



$pdf->Output('Reporte Institucional.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>