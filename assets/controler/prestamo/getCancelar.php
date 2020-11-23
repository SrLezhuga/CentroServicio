<?php
session_start();
include "../conexion.php";
$id = $_GET['id'];

$query = "SELECT * FROM tab_prestamo  WHERE Id_prestamo = " . $id;
($resultSet = mysqli_query($con, $query)) or die("Error de consulta");
$item = mysqli_fetch_array($resultSet);

echo "
<form class='form' action='assets/controler/prestamo/canPrestamo.php' method='POST'>
      <div class='row'>
        <div class='col-4'>
          <i class='fas fa-exclamation-triangle' style='font-size: 10rem; color: gold; padding: 10% 20% 10% 20%;'></i>
        </div>
        <div class='col-8'>
      <input type='hidden' name='formPreFin' value='".$item['id_prestamo']."'/>
      <input type='hidden' name='formPreHer' value='".$item['id_herramienta']."'/>
      <div class='col-12'>
        <label>Código herramienta:</label>
        <span class='input-group-text' style='background-color: white;'>
          <i class='fas fa-barcode'></i>
          <a>&nbsp;&nbsp;".$item['cod_herramienta']."</a>
        </span>
      </div>
      <div class='col-12'>
        <label>Cliente:</label>
        <span class='input-group-text' style='background-color: white;'>
        <i class='fas fa-user'></i>
          <a>&nbsp;&nbsp;".$item['cliente_prestamo']."</a>
        </span>
      </div>
      <div class='col-12'>
        <label>Estado préstamo:</label>
        <span class='input-group-text' style='background-color: white;'>
        <i class='fas fa-stethoscope'></i>
          <a>&nbsp;&nbsp;".$item['status_prestamo']."</a>
        </span>
      </div></div>
    </div>
    <br>
    <div class='row'>
      <div class='col'>
        <button type='submit' class='btn btn-outline-danger btn-block'><i class='fas fa-undo-alt'></i> Finalizar</button>
      </div>
    </div>
</form>
";

mysqli_close($con);
?>