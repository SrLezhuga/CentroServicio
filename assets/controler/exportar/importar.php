<?php
include_once "conexion.php";

function getQuery(){

    $mysqli = conectar();
    $sql = "SELECT * FROM tab_refaccion";
    return $mysqli->query($sql);
    }

?>