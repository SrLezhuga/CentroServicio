<?php

include "conexion.php";

$user = $_POST['formUser'];
$password = $_POST['formPass'];
$user_id = 0;

//$encry=$_POST["formPass"];
$sql = "SELECT * FROM tab_users WHERE nick_user= '$user' AND pass_user = '$password'";
$query = $con->query($sql);
$rs = $query->fetch_array();
$user_id = $rs['code_user'];

if ($user_id == 0) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/index.php?alert=1");
} else {
    session_start();
    $_SESSION['priv_user'] = $rs['priv_user'];
    $_SESSION['name_user'] = $rs['name_user'];
    $_SESSION['code_user'] = $user_id;
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/inicio.php");
}

mysqli_close($con);
?>
