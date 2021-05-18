<?php 

include_once 'conexion.php';
class EliminarCompra{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }
}