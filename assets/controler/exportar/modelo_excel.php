<?php
class Modelo_Excel{
    private $conexion;
    function __construct()
    {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }
    function Registrar_Excel($array_id,$array_codigo,$array_descripcion,$array_marca,$array_cantidad,$array_unidad,$array_costo){
        $sql = "INSERT INTO tab_refaccion VALUES ($array_id,'$array_codigo','$array_descripcion','$array_marca','$array_unidad',$array_cantidad,$array_costo)
                ON DUPLICATE KEY UPDATE
                cod_refaccion = '$array_codigo', 
                desc_refaccion = '$array_descripcion', 
                marca_refaccion = '$array_marca', 
                cant_refaccion = cant_refaccion + $array_cantidad, 
                unidad_refaccion = '$array_unidad', 
                costo_refaccion = $array_costo";
        if ($resultado = $this->conexion->conexion->query($sql)) {
            $id_retornado = mysqli_insert_id($this->conexion->conexion);
            return 1;
        }else {
            return 0;
        }
        $this->conexion->cerrar();
    }
    function RegistrarNvo_Excel($array_codigo,$array_descripcion,$array_marca,$array_cantidad,$array_unidad,$array_costo){
        $sql = "INSERT INTO tab_refaccion VALUES (null,'$array_codigo','$array_descripcion','$array_marca','$array_unidad',$array_cantidad,$array_costo)";
        if ($resultado = $this->conexion->conexion->query($sql)) {
            $id_retornado = mysqli_insert_id($this->conexion->conexion);
            return 1;
        }else {
            return 0;
        }
        $this->conexion->cerrar();
    }
}



?>