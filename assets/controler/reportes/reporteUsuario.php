<?php 
session_start();

$lista = $_POST['RepUsuario'];

$_SESSION['RepUsuario'] = $lista;

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
    include_once 'generarUsuarioAll.php';
    $html=ob_get_clean();
  }else{
    ob_start();
    include_once 'generarUsuario.php';
    $html=ob_get_clean();
  }

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('Letter', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Add the header
$canvas = $dompdf->get_canvas();
$footer = $canvas->open_object();

    $canvas->page_text(560, 760, "{PAGE_NUM} de {PAGE_COUNT}",
    "helvetica", 10, array(0,0,0));

$canvas->close_object();
$canvas->add_object($footer, "all");

// Output the generated PDF to Browser

$dompdf->stream($lista." ".date('Y-m-d', strtotime("now")),array('Attachment'=>0));

session_unset($_SESSION['RepUsuario']);
?>