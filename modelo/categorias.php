<?php

include_once 'conexion.php';

class Categoria{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }

    function rellenar_categorias(){
        $sql="SELECT * FROM categorias";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchAll();
        return $this->objetos;    
    
    } 
    

}

?>