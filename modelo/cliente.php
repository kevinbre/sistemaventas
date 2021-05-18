<?php 

include 'conexion.php';
class Cliente{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$dni,$email,$telefono,$direccion){
        $sql="SELECT dni_cliente FROM clientes WHERE dni_cliente=:dni";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':dni'=>$dni));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){            
            echo false;            
        }
        else{
            $sql ="INSERT INTO clientes(nombre_cliente,dni_cliente,email_cliente,telefono_cliente,direccion_cliente) VALUES (:nombre,:dni,:email,:telefono,:direccion) ";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre, ':dni'=>$dni,':email'=>$email,':telefono'=>$telefono,':direccion'=>$direccion));          
            echo true;
            
        }
    }
    function buscar_cliente(){
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            
            $sql="SELECT * FROM clientes WHERE nombre_cliente LIKE :consulta OR dni_cliente LIKE :consulta ";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }else{
            $sql="SELECT * FROM clientes WHERE nombre_cliente  NOT LIKE '' ORDER BY nombre_cliente";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
    
    }
        function borrar($id){
        $sql="DELETE FROM clientes where id_cliente=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }else{
            echo 'noborrado';
        }
        }

function editar($id, $nombre, $telefono, $email, $direccion){
    $sql="SELECT id_cliente FROM clientes WHERE id_cliente=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchall();
    if(empty($this->objetos)){
        echo false;
    }else{
        $sql="UPDATE clientes SET nombre_cliente=:nombre, telefono_cliente=:telefono, email_cliente=:email, direccion_cliente=:direccion WHERE id_cliente=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$nombre,':telefono'=>$telefono, ':email'=>$email,':direccion'=>$direccion));
        echo true;
    }
}
function rellenar_clientes(){
    $sql="SELECT * FROM clientes";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this-> objetos;

}
function contar_clientes(){
    $sql="SELECT COUNT(id_cliente) as totalclientes FROM clientes";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this-> objetos;

}
function contar_catalogo(){
    $sql="SELECT COUNT(id_producto) as totalproductos FROM productos";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this-> objetos;
}
function contar_ventas(){
    $sql="SELECT COUNT(id_venta) as totalventas FROM ventas";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this-> objetos;
}
function contar_compras(){
    $sql="SELECT COUNT(id_compra) as totalcompras FROM compras";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this-> objetos;
}

}

?>