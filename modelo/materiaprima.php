<?php 

include_once 'conexion.php';
class MateriaPrima{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }
    
    function crear($nombre,$medicion,$existencia,$proveedor){
        $sql="SELECT id_materiaprima, nombre_proveedor FROM materiasprimas JOIN proveedores WHERE id_materiaprima=:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }else{
            $sql ="INSERT INTO materiasprimas(nombre_materiaprima, medicion_materiaprima, existencia_materiaprima, id_prov_mp) VALUES (:nombre,:medicion,:existencia, :proveedor)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':medicion'=>$medicion,':existencia'=>$existencia, ':proveedor'=> $proveedor));
        }   if(empty($query)){
            
        }   else { 

        }
    } 
    function ultima_materiaprima(){
        $sql="SELECT id_materiaprima, id_prov_mp as ultimoproveedor FROM materiasprimas WHERE id_materiaprima = (SELECT MAX(id_materiaprima) FROM materiasprimas)";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function crear_materiaprima($id_materiaprima, $id_proveedor){
        $sql ="INSERT INTO mp_por_prov(id_mp_pv, id_prov) VALUES (:materiaprima, :proveedor)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':materiaprima'=>$id_materiaprima, ':proveedor'=> $id_proveedor));
        if(empty($query)){
            
        }   else {
            echo 'add';
        }

    }


    function buscar_materiaprima(){
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];            
            $sql="SELECT id_materiaprima, nombre_materiaprima, existencia_materiaprima, medicion_materiaprima,proveedores.id_proveedor, proveedores.nombre_proveedor as proveedor FROM materiasprimas 
            JOIN proveedores ON  id_prov_mp = id_proveedor AND nombre_materiaprima LIKE :consulta OR id_prov_mp = id_proveedor AND medicion_materiaprima LIKE :consulta OR id_prov_mp = id_proveedor AND proveedores.nombre_proveedor LIKE :consulta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }else{
            $sql="SELECT id_materiaprima, nombre_materiaprima, existencia_materiaprima, medicion_materiaprima,proveedores.id_proveedor, proveedores.nombre_proveedor as proveedor  FROM materiasprimas 
            JOIN proveedores ON  id_prov_mp = id_proveedor AND nombre_materiaprima NOT LIKE '' ORDER BY nombre_materiaprima";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
    
    }
    
        function borrar($id){
        $sql="DELETE FROM materiasprimas where id_materiaprima=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }else{
            echo 'noborrado';
        }
        }

function editar($id, $nombre, $medicion, $existencia){
    $sql="SELECT id_materiaprima FROM materiasprimas WHERE id_materiaprima=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchall();
    if(empty($this->objetos)){
        echo false;
    }else{
        $sql="UPDATE materiasprimas SET nombre_materiaprima=:nombre, medicion_materiaprima=:medicion, existencia_materiaprima=:existencia WHERE id_materiaprima=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$nombre,':medicion'=>$medicion, ':existencia'=>$existencia));
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
}



?>