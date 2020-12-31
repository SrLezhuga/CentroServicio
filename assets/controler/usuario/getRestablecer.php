<?php
session_start();
include "../conexion.php";
$id = $_GET['id'];

//Carácteres para la contraseña
$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890*#.";
$password = "Mfa@";
//Reconstruimos la contraseña segun la longitud que se quiera
for($i=0;$i<6;$i++) {
  //obtenemos un caracter aleatorio escogido de la cadena de caracteres
  $password .= substr($str,rand(0,65),1);
}

$query = "SELECT * FROM tab_users WHERE code_user = " . $id;
$resultSet = mysqli_query($con, $query) or die("Error de consulta");
$item = mysqli_fetch_array($resultSet);

echo "
<form class='form' action='assets/controler/usuario/restUsuario.php' method='POST'>
    <input type='hidden' class='form-control' name='formUseId' required value=". $item['code_user'] .">
    <input type='hidden' class='form-control' name='formPasId' required value=". $password .">
      <div class='row'>
        <div class='col-4'>
          <i class='fas fa-exclamation-triangle' style='font-size: 10rem; color: gold; padding: 10% 20% 10% 20%;'></i>
        </div>
        <div class='col-8'>
            <br>
            <h3 class='text-center'>Se restablecerá la contraseña de:</h3>
            <h3 class='text-center'><b>". $item ['name_user'] ."</b></h3>
            <h3 class='text-center'>Contraseña generada: <b>".$password."</b></h3>
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

mysqli_close($con);
?>