<?php
session_start();
include "../conexion.php";
$id = $_GET['id'];

$items = explode("|", $id);
$items[1];
$items[0];
$refaccion = str_replace("°", " ", $items[1]);

$query = "SELECT * FROM tab_ordenrefaccion WHERE cod_refaccion = '$refaccion'";
($resultSet = mysqli_query($con, $query)) or die("Error de consulta");
$item = mysqli_fetch_array($resultSet);

echo "
<form class='form' action='assets/controler/refaccion/upRefaccion.php' method='POST'>
      <div class='row'>
        <div class='col-4'>
          <i class='fas fa-exclamation-triangle' style='font-size: 10rem; color: gold; padding: 10% 20% 10% 20%;'></i>
        </div>
        <div class='col-8'>
      <input type='hidden' name='formRefId' value='".$refaccion."' required />
      <input type='hidden' name='formOrdId' value='".$items[0]."' required />
      <div class='col-12'>
        <label>Código:</label>
        <span class='input-group-text' style='background-color: white;'>
          <i class='fas fa-barcode'></i>
          <a>&nbsp;&nbsp;".$item['cod_refaccion']."</a>
        </span>
      </div>
      <div class='col-12'>
        <label>Descripción:</label>
        <span class='input-group-text' style='background-color: white;'>
          <i class='fas fa-tasks'></i>
          <a>&nbsp;&nbsp;".$item['desc_refaccion']."</a>
        </span>
      </div>
      <div class='col-12'>
        <label>Marca:</label>
        <span class='input-group-text' style='background-color: white;'>
          <i class='fas fa-tag'></i>
          <a>&nbsp;&nbsp;".$item['marca_refaccion']."</a>
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