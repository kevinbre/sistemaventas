<?php 
include_once '../modelo/ventaProducto.php';
include_once '../modelo/eliminarVenta.php';
include_once '../modelo/producto.php'; 
include_once '../modelo/venta.php';

$venta_producto = new VentaProducto();
$venta = new Venta();
$eliminar_venta = new EliminarVenta();
$producto = new Producto();
if($_POST['funcion']=='borrar_venta'){
    $id_venta=$_POST['id'];
    $venta_producto -> recuperar($id_venta);
    foreach ($venta_producto->objetos as $det){
        $producto->devolver($det->producto_id,$det->cantidad_producto);
    }
    $venta->borrar($id_venta);
    
    
}