<?php
session_start();
include("conexion.php");

// Obtengo los datos cargados en el formulario de login.
$user     = $_POST['formUser'];
$password = $_POST['formPass'];

// Consulta segura para evitar inyecciones SQL.

$sql = "SELECT * FROM tab_users WHERE nick_user= '$user' AND pass_user = '$password'";
$resultado = mysqli_query($con, $sql) or die("Error de consulta");
$user = mysqli_fetch_array($resultado);
/*  
echo "<pre>";
print_r($user);
echo "</pre>";
*/
// Verificando si el usuario existe en la base de datos.
if ($resultado) {
    // Guardo en la sesión el email del usuario.
    $_SESSION['priv_user'] = $user['priv_user'];
    $_SESSION['name_user'] = $user['name_user'];
    // Redirecciono al usuario a la página principal del sitio.
    echo "Logeado";
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/inicio.php");
    
} else {
    echo 'El email o password es incorrecto';
}

mysqli_close($con);
?>