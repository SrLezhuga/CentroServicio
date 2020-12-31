<?php
 
include "conexion.php";

$user      = $_POST['formUser'];
$password  = $_POST['formPass'];
$user_id   = 0;

$encry=sha1($password);
$sql        =  "SELECT * FROM tab_users WHERE nick_user= '$user' AND pass_user = '$encry'";
$query      =  $con->query($sql);
$rs         =  $query->fetch_array();
$user_id    =  $rs['code_user'];
$items      =  $rs['conf_user'];
$avatar     =  "assets/img/Avatar/".$items.".png";

if ($user_id == 0) {
    header("Location: http://" . $base_url . "/CentroServicio/index?alert=1");
} else {
    session_start();
    $_SESSION['priv_user'] = $rs['priv_user'];
    $_SESSION['name_user'] = $rs['name_user'];
    $_SESSION['code_user'] = $user_id;
    $_SESSION['avatar']    = $avatar;
    header("Location: http://" . $base_url . "/CentroServicio/inicio");
}

mysqli_close($con);

?>