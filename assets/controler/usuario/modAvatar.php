<?php
session_start();
include("../conexion.php");

$avatar     = $_POST['Avatar'];
$user       = $_SESSION['code_user'];

$sql = "UPDATE tab_users
SET   conf_user  = ".$avatar."
WHERE code_user   = ".$user.";";
if (mysqli_query($con, $sql)) {
    $_SESSION['avatar']    = $avatar;
    header("HTTP/1.0 404 Not Found");
    header("Location: http://" . $base_url . "/CentroServicio/ajustes?alert=3'");
}

mysqli_close($con);
?>