<?php 

include 'conexion.php';
class Catalogo{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }

        function buscar_catalogo(){
        $sql="SELECT sku_producto, nombre_producto, precio_producto, stock_producto, categorias.nombre_categoria FROM productos JOIN categorias WHERE id_categoria=tipo_producto";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }

   /* function buscar_producto_catalogo (){
        $sql="SELECT * FROM clientes";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;

    }*/

function borrar_producto($id){    
        $sql="DELETE FROM clientes where id_cliente=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }else{
            echo 'noborrado';
        }
        }
}


?>