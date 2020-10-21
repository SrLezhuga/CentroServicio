<?php
session_start();
include "../conexion.php";
$id = $_GET['id'];

$items = explode("|", $id);
$items[1];
$items[0];

$query = "SELECT * FROM tab_ordenservicio WHERE cod_servicio = $items[1] AND id_orden = $items[0]";
($resultSet = mysqli_query($con, $query)) or die("Error de consulta");
$item = mysqli_fetch_array($resultSet);

echo "
<form class='form' action='assets/controler/servicio/upServicio.php' method='POST'>
      <div class='row'>
        <div class='col-4'>
          <i class='fas fa-exclamation-triangle' style='font-size: 10rem; color: gold; padding: 10% 20% 10% 20%;'></i>
        </div>
        <div class='col-8'>
      <input type='hidden' name='formSerId' value='".$items[1]."' required />
      <input type='hidden' name='formOrdId' value='".$items[0]."' required />
      <div class='col-12'>
        <label>Código:</label>
        <span class='input-group-text' style='background-color: white;'>
          <i class='fas fa-barcode'></i>
          <a>&nbsp;&nbsp;".$item[cod_servicio]."</a>
        </span>
      </div>
      <div class='col-12'>
        <label>Descripción:</label>
        <span class='input-group-text' style='background-color: white;'>
          <i class='fas fa-tasks'></i>
          <a>&nbsp;&nbsp;".$item[desc_servicio]."</a>
        </span>
      </div>
      <div class='col-12'>
        <label>Marca:</label>
        <span class='input-group-text' style='background-color: white;'>
        <i class='fas fa-dollar-sign'></i>
          <a>&nbsp;&nbsp;".$item[costo_servicio].".00</a>
        </span>
      </div></div>
    </div>
    <br>
    <div class='row'>
      <div class='col'>
        <button type='submit' class='btn btn-outline-danger btn-block'><i class='fas fa-eraser'></i> Quitar</button>
      </div>
    </div>
</form>
";
mysqli_close($con);
?>