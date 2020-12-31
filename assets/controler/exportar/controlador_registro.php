<?php
require "modelo_excel.php";
    $ME = new Modelo_Excel();
 
    $id=htmlspecialchars($_POST['id'],ENT_QUOTES,"UTF-8");
    $codigo=htmlspecialchars($_POST['codi'],ENT_QUOTES,"UTF-8");
    $descripcion=htmlspecialchars($_POST['desc'],ENT_QUOTES,"UTF-8");
    $marca=htmlspecialchars($_POST['marc'],ENT_QUOTES,"UTF-8");
    $costo=htmlspecialchars($_POST['cost'],ENT_QUOTES,"UTF-8");

    $costEx=str_replace("$","", $costo);

    $array_id=explode(",",$id);
    $array_codigo=explode(",",$codigo);
    $array_descripcion=explode(",",$descripcion);
    $array_marca=explode(",",$marca);
    $array_costo=explode(",",$costEx);

    for ($i=0; $i < count($array_codigo); $i++) { 
        if ($array_id[$i]=="NUEVO") {
            $consulta = $ME->RegistrarNvo_Excel($array_codigo[$i],$array_descripcion[$i],$array_marca[$i],$array_costo[$i]);
        }else {
            $consulta = $ME->Registrar_Excel($array_id[$i],$array_codigo[$i],$array_descripcion[$i],$array_marca[$i],$array_costo[$i]);
        }
    }
    echo $consulta;
?>