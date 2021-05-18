<?php 
include '../modelo/venta.php';
include_once '../modelo/conexion.php';
$venta = new Venta();
session_start();
$vendedor = $_SESSION['usuario'];
if($_POST['funcion']=='registrar_compra'){
    $total = $_POST['total'];
    $cliente = $_POST['cliente']; 
    $productos = json_decode($_POST['json']);
    date_default_timezone_set('America/Argentina/San_Juan');
    $fecha = date('Y-m-d H:i:s');
    $venta->Crear($cliente,$total,$fecha,$vendedor);
    $venta->ultima_venta();
    foreach ($venta->objetos as $objeto){
        $id_venta = $objeto->ultima_venta;
        echo $id_venta;
    }
    try{
        $db = new Conexion();
        $conexion = $db->pdo;
        $conexion -> beginTransaction();
        foreach($productos as $prod){
            $cantidad = $prod->cantidad;
            if($cantidad !=0){              
                $sql="SELECT * FROM productos JOIN venta_producto WHERE id_producto = :id";
                $query = $conexion->prepare($sql);
                $query->execute (array(':id'=> $prod->id));
                $stock=$query->fetchall();
                $subtotal = $prod->cantidad*$prod->precio;               
                $conexion->exec("UPDATE productos SET stock_producto = stock_producto - '$prod->cantidad' WHERE id_producto = '$prod->id'");              
                $conexion->exec("INSERT INTO venta_producto (cantidad_producto, precio_producto_venta, producto_id, id_venta_producto) VALUES ('$prod->cantidad','$subtotal','$prod->id','$id_venta') ");
               
                }
                
            }
            $conexion->commit();      

    }catch (Exception $error){       
        $conexion -> rollBack();
        $venta->borrar($id_venta);
        echo $error->getMessage();

    }

}

?>