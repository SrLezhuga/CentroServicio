<?php
class conexion{
    private $servidor;
    private $usuario;
    private $contra;
    private $db;

    public $conexion;
    public function __construct()
    {
        $this->servidor = "localhost";
        $this->usuario = "root";
        $this->contra = "";
        $this->db = "fma_csa";
    }
    function conectar(){
        $this->conexion = new mysqli($this->servidor,$this->usuario,$this->contra,$this->db);
        $this->conexion->set_charset("UTF-8");
    }
    function cerrar(){
        $this->conexion->close();
    }
}



?>