<?php 

include 'conexion.php';
class Stock{
    var $objetos;
    public function __construct()    {
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }

    function crear ($prod_id, $prod_stock){
        $sql="INSERT INTO stock (stock, id_productos) VALUES (:stock, :prod_id)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':stock'=>$prod_stock, ':prod_id'=>$prod_id));
        echo 'agregado';

    }
}

    ?>