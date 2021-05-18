<?php 

include_once 'conexion.php';
class Producto{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }
    
    function crear($sku,$nombre,$tipo,$precio){
        $sql="SELECT sku_producto, nombre_categoria FROM productos JOIN categorias WHERE sku_producto=:sku";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':sku'=>$sku));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }else{
            $sql ="INSERT INTO productos(sku_producto,nombre_producto,tipo_producto,precio_producto) VALUES (:sku,:nombre,:tipo,:precio)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':sku'=>$sku, ':nombre'=>$nombre,':tipo'=>$tipo,':precio'=>$precio));
            echo 'add';
        }
    }

   /*function buscar_producto_data(){
        $sql="SELECT sku_producto, nombre_producto, tipo_producto, precio_producto, stock_producto FROM productos ";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }*/

    function buscar_producto(){
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];            
            $sql="SELECT id_producto, sku_producto, tipo_producto, nombre_producto, stock_producto, precio_producto, categorias.nombre_categoria AS tipo 
            FROM productos JOIN categorias 
            ON tipo_producto = id_categoria AND sku_producto LIKE :consulta 
            OR tipo_producto = id_categoria AND nombre_producto LIKE :consulta
            OR tipo_producto = id_categoria AND categorias.nombre_categoria LIKE :consulta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }else{
            $sql="SELECT id_producto, sku_producto, tipo_producto, nombre_producto, stock_producto, precio_producto, categorias.nombre_categoria AS tipo FROM productos JOIN categorias ON tipo_producto = id_categoria AND nombre_producto NOT LIKE '' ORDER BY nombre_producto";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
    
    }


        function borrar($id){
        $sql="DELETE FROM productos where id_producto=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }else{
            echo 'noborrado';
        }
        }

function editar($id, $nombre, $precio, $tipo_id){
    $sql="SELECT id_producto FROM productos WHERE id_producto=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchall();
    if(empty($this->objetos)){
        echo false;
    }else{
        $sql="UPDATE productos SET nombre_producto=:nombre, precio_producto=:precio, tipo_producto=:tipo_id WHERE id_producto=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$nombre,':precio'=>$precio, ':tipo_id'=>$tipo_id));
        echo true;
    }

   
}
function editar_stock ($prod_id,$prod_stock){
    $sql="SELECT id_producto FROM productos WHERE id_producto=:prod_id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':prod_id'=>$prod_id));
    $this->objetos=$query->fetchall();
    if(empty($this->objetos)){
        echo false;
    }else{
        $sql="UPDATE productos SET stock_producto=:stock WHERE id_producto=:prod_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':prod_id'=>$prod_id,':stock'=>$prod_stock));
        echo true;
    }
}

function buscar_id($id){
    $sql="SELECT id_producto, sku_producto, tipo_producto, nombre_producto, stock_producto, precio_producto, categorias.nombre_categoria AS tipo FROM productos JOIN categorias ON tipo_producto = id_categoria WHERE id_producto=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchAll();
    return $this->objetos;
    }

function buscar_stock($id){
    $sql="SELECT id_producto, stock_producto as total FROM productos WHERE id_producto=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchAll();
    return $this->objetos;
}
function devolver($producto_id, $cantidad_producto){
    $sql="SELECT * FROM productos WHERE id_producto = :producto_id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':producto_id'=>$producto_id));
    $stock=$query->fetchAll();
    if(!empty($stock)){
        $sql="UPDATE productos SET stock_producto = stock_producto+:cantidad_producto WHERE id_producto=:producto_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':cantidad_producto'=>$cantidad_producto,':producto_id'=>$producto_id));
        echo true;

    }
    
}

function rellenar_productos(){
    $sql="SELECT * FROM materiasprimas ORDER BY nombre_materiaprima ASC";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this-> objetos;

}
function sumarTotal($id){
    $sql="SELECT SUM(precio_mp) as totalsuma from compra_mp WHERE compra_id=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchall();
    return $this-> objetos;
}
}



?>