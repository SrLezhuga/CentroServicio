<?php
include("../conexion.php");

    $validar=$_POST['usuario'];
   
    $sql = "SELECT count(*) AS cont FROM tab_users WHERE nick_user = '" . $validar."'";
    $query      =  $con->query($sql);
    $rs         =  $query->fetch_array();

    if ($rs['cont']==0) {
        $validacion=0;
    }else {
        $validacion=1;
    }

    echo $validacion;
?>