<?php

//PRODUCCION
/*$host="";
$user="";
$password="";
$db="";*/

//LOCAL
$host     = "localhost";
$user     = "root";
$password = "May0r30F3rr3t3r0.2021";
$db       = "fma_csa";

$con = new mysqli($host, $user, $password, $db) or die("No se ha podido conectar al servidor de Base de datos");
mysqli_set_charset($con, 'utf8');
$db = mysqli_select_db($con, $db) or die("Upps! Pues va a ser que no se ha podido conectar a la base de datos");
$con->query("set names utf8");

$base_url="192.168.0.98";

?>