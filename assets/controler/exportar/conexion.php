<?php
    function conectar(){
        $servidor = "localhost";
        $usuario = "root";
        $contra = "May0r30F3rr3t3r0.2021";
        $db = "fma_csa";

        $conexion = new mysqli($servidor,$usuario,$contra,$db);
        $conexion->set_charset("UTF-8");

        return $conexion;
    } 

?>