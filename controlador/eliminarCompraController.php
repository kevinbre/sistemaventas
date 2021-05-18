<?php 
include_once '../modelo/eliminarCompra.php';
include_once '../modelo/compras.php'; 
include_once '../modelo/existencia.php';

$compras = new Compras();
$eliminar_compra = new EliminarCompra();
$existencia = new Existencia();
if($_POST['funcion']=='borrar_compra'){
    $id_compra=$_POST['id'];
    $compras -> recuperar($id_compra);
    foreach ($compras->objetos as $det){
        $existencia->devolver($det->materiaprima_id,$det->cantidad_mp);
    }
    $compras->borrar_mp($id_compra);
    $compras->borrar($id_compra);
    
    
}