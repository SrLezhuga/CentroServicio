<?php

$recaptcha_secret = '6Lc4P90ZAAAAAGnr8E1nqgM0ReA3cZJIePLiciB1'; 
$recaptcha_response = $_POST['recaptcha_response']; 
$url = 'https://www.google.com/recaptcha/api/siteverify'; 

$data = array( 'secret' => $recaptcha_secret, 'response' => $recaptcha_response, 'remoteip' => $_SERVER['REMOTE_ADDR'] ); 
$curlConfig = array( CURLOPT_URL => $url, CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $data ); 
$ch = curl_init(); 
curl_setopt_array($ch, $curlConfig); 
$response = curl_exec($ch); 
curl_close($ch);

$jsonResponse = json_decode($response);
if ($jsonResponse->success === true) { 
    // Código para procesar el formulario
    
include "conexion.php";

$user      = $_POST['formUser'];
$password  = $_POST['formPass'];
$user_id   = 0;

//$encry=$_POST["formPass"];
$sql        =  "SELECT * FROM tab_users WHERE nick_user= '$user' AND pass_user = '$password'";
$query      =  $con->query($sql);
$rs         =  $query->fetch_array();
$user_id    =  $rs['code_user'];
$items      =  explode("-", $rs['conf_user']);
$avatar     =  "assets/img/Avatar/".$items[0].".png";

if ($user_id == 0) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/index?alert=1");
} else {
    session_start();
    $_SESSION['priv_user'] = $rs['priv_user'];
    $_SESSION['name_user'] = $rs['name_user'];
    $_SESSION['code_user'] = $user_id;
    $_SESSION['avatar']    = $avatar;
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/inicio");
}

mysqli_close($con);
} else {
   // Código para aviso de error
   header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/index?alert=1");
}



?>