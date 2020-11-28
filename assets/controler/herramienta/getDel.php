<?php
session_start();
include "../conexion.php";
$id = $_GET['id'];

$query = "SELECT * FROM tab_herramienta WHERE Id_herramienta = " . $id;
$resultSet = mysqli_query($con, $query) or die("Error de consulta");
$item = mysqli_fetch_array($resultSet);

echo "
<form class='form' action='assets/controler/herramienta/downHerramienta.php' method='POST'>
    <input type='hidden' class='form-control' name='formHerId' required value=". $item['Id_herramienta'] .">
      <div class='row'>
        <div class='col-4'>
          <i class='fas fa-exclamation-triangle' style='font-size: 10rem; color: gold; padding: 10% 20% 10% 20%;'></i>
        </div>
        <div class='col-8'>
            <br>
            <h3 class='text-center'>Se eliminará la herramienta:</h3>
            <h3 class='text-center'><b>". $item ['desc_herramienta'] ."</b></h3>
            <h3 class='text-center'>¿Deseas continuar?</h3>
        </div>
    </div>
    <br>
    <div class='row'>
      <div class='col'>
        <button type='submit' class='btn btn-outline-danger btn-block'><i class='fas fa-trash-alt'></i> Eliminar</button>
      </div>
    </div>
</form>
";

mysqli_close($con);
?>