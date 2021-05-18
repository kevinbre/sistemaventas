<?php 

include_once 'conexion.php';
class Venta{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }
    function Crear($cliente,$total,$fecha,$vendedor){
        $sql ="INSERT INTO ventas(id_cliente_venta, total_venta, fecha_venta, id_vendedor) VALUES (:cliente, :total, :fecha, :vendedor) ";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':cliente'=>$cliente, ':total'=>$total, ':fecha'=>$fecha, ':vendedor'=>$vendedor));          
        echo true;

    }
    function ultima_venta(){
        $sql="SELECT MAX(id_venta) as ultima_venta FROM ventas";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function borrar($id_venta){
        $sql ="DELETE FROM ventas WHERE id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));          
        echo true;
    }
    function buscar(){ 
        $sql="SELECT * FROM ventas JOIN clientes WHERE id_cliente = id_cliente_venta ";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }

    function buscar_id($id_venta){ 
        $sql="SELECT * FROM ventas JOIN usuarios JOIN clientes on id_vendedor = id_usuario AND id_venta=:id_venta AND id_cliente_venta= id_cliente";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));
        $this->objetos=$query->fetchall();
        return $this->objetos;          
    }   
  
    function buscar_productos($id_venta){
        $sql="SELECT SUM(precio_producto_venta) AS subtotal FROM venta_producto JOIN ventas ON id_venta = :id_venta AND id_venta_producto = id_venta ";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));
        $this->objetos=$query->fetchall();
        return $this->objetos;
            }
    function venta_mes(){
    $sql="SELECT SUM(total_venta) as cantidad, month(fecha_venta) as mes  FROM ventas WHERE year(fecha_venta) = year (curdate()) group by month(fecha_venta)";
    $query = $this->acceso->prepare($sql);
    $query->execute();
     $this->objetos=$query->fetchall();
    return $this->objetos;
    }  
    
    
    
    
    
}

?>