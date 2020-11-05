<?php
session_start();
include("../conexion.php");
$id = $_GET['id'];


$items = explode("|", $id);
$items[0];
$items[1];

$folio = $items[0];
if (strlen($folio) == 1) {
    $folio = "0000" . $folio;
} else if (strlen($folio) == 2) {
    $folio = "000" . $folio;
} else if (strlen($folio) == 3) {
    $folio = "00" . $folio;
} else if (strlen($folio) == 4) {
    $folio = "0" . $folio;
}

if ($items[1] == "Taller") {
    echo "
    <i class='fas fa-exclamation-triangle' style='font-size: 8rem; color: gold; margin-left: 42%;'></i>
    <br>
    <h3 class='text-center'>La orden ya esta en taller, elige otro estado.</h3>
    ";
} else {

    echo "
    <h3 class='text-center'>Se cambiara el estado de la orden. ¿Deseas continuar?</h3>
    <form class='form' action='assets/controler/taller/upTaller.php' method='POST'>
         <div class='row'>
           <div class='col-4'>
             <i class='fas fa-exclamation-triangle' style='font-size: 9rem; color: gold; padding: 1% 20% 3% 20%;'></i>
           </div>
           <div class='col-8'>
         <input type='hidden' name='formId' value=" . $items[0] . " required />
         <input type='hidden' name='formStatus' value='" . $items[1] . "' required />
         <div class='col-12'>
           <label>Folio Orden:</label>
           <span class='input-group-text' style='background-color: white;'>
            <i class='fas fa-hashtag'></i>
             <a>&nbsp;&nbsp; " . $folio . "</a>
           </span>
         </div>
         <div class='col-12'>
           <label>Estado Orden:</label>
           <span class='input-group-text' style='background-color: white;'>
            <i class='fas fa-stethoscope'></i>
             <a>&nbsp;&nbsp;" . $items[1] . "</a>
           </span>
         </div>
         </div>
       </div>
       <div class='alert alert-info' style='text-align: center;'>
            <strong>Nota:</strong> El estatus <b>Reparado</b> y <b>Cancelado</b> finalizaran la orden y no permitiran hacer cambios futuros.
        </div>
       <div class='row'>
         <div class='col'>
           <button type='submit' class='btn btn-outline-danger btn-block'><i class='fas fa-sync-alt'></i></i> Actualizar</button>
         </div>
       </div>
       
   </form>
   ";
}
