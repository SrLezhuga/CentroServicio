<?php 
session_start();

$fechaIni =  $_POST['forFecIni'];
$fechaSal =  $_POST['forFecFin'];
$lista    =  $_POST['fromRepList'];

$_SESSION['fechIn']=$fechaIni;
$_SESSION['fechOut']=$fechaSal;
$_SESSION['lista']=$lista;

require_once '../../vendor/dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

// instantiate and use the dompdf class
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$dompdf = new Dompdf($options);

if ($lista =='Todos') {
  ob_start();
  include_once 'generarAll.php';
  $html=ob_get_clean();
}else{
  ob_start();
  include_once 'generarStatus.php';
  $html=ob_get_clean();
}

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('Letter', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser

$dompdf->stream('document.pdf',array('Attachment'=>0));

session_unset($_SESSION['fechIn']);
session_unset($_SESSION['fechOut']);
session_unset($_SESSION['lista']);
?>