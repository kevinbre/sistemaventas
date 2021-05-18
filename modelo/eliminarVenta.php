<?php 

include_once 'conexion.php';
class EliminarVenta{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acceso=$db->pdo;
    } 
    function ver($id){ 
        $sql="SELECT precio_producto_venta, cantidad_producto, 
        productos.nombre_producto,productos.precio_producto, 
        categorias.nombre_categoria, 
        ventas.id_venta, 
        clientes.nombre_cliente
        FROM venta_producto
        JOIN productos on producto_id = id_producto
        JOIN categorias on tipo_producto = id_categoria
        JOIN ventas on id_venta = id_venta_producto
        JOIN clientes on id_cliente = id_cliente_venta
        WHERE id_venta_producto = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}

?>