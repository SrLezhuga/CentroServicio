<?php
session_start();
include "../conexion.php";
$id = $_GET['id'];

$queryOrden = "SELECT *  FROM tab_orden WHERE id_orden =" . $id;
($rsOrden = mysqli_query($con, $queryOrden)) or die("Error de consulta");
while ($Orden = mysqli_fetch_array($rsOrden)) {
    $folio = $Orden['id_orden'];
    if (strlen($folio) == 1) {
        $folio = "0000" . $folio;
    } elseif (strlen($folio) == 2) {
        $folio = "000" . $folio;
    } elseif (strlen($folio) == 3) {
        $folio = "00" . $folio;
    } elseif (strlen($folio) == 4) {
        $folio = "0" . $folio;
    }

echo "
<form class='form' action='assets/controler/orden/liberarOrden.php' method='POST'>
    <input type='hidden' class='form-control' name='formOrdId' required value=". $id .">
      <div class='row'>
        <div class='col-4'>
          <i class='fas fa-exclamation-triangle' style='font-size: 10rem; color: gold; padding: 10% 20% 10% 20%;'></i>
        </div>
        <div class='col-8'>
            <br>
            <h3 class='text-center'>Se liberará la orden:</h3>
            <h3 class='text-center' style='color: crimson;'><b>FOLIO: ". $folio ."</b></h3>
            <h3 class='text-center'>¿Deseas continuar?</h3>
        </div>
    </div>
    <br>
    <div class='row'>
      <div class='col'>
        <button type='submit' class='btn btn-outline-danger btn-block'><i class='fas fa-sync-alt'></i> Restablecer</button>
      </div>
    </div>
</form>
";
  }
mysqli_close($con);
?>