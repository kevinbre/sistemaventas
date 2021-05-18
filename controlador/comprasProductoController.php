<?php 
include_once '../modelo/compras.php';
$compra_producto = new Compras();
if($_POST['funcion']=='obtenerDatos'){
    $id=$_POST['id'];
    $compra_producto-> obtenerDatos($id);
    $json=array();
    foreach($compra_producto->objetos as $objeto){
        $json[]=$objeto;

    }
    $jsonstring = json_encode($json);
    echo $jsonstring;

}