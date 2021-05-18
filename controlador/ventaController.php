<?php
include '../modelo/venta.php';
$venta = New Venta();
if($_POST['funcion']=='listar'){
    $venta-> buscar();
    $json=array();
    foreach($venta->objetos as $objeto){
        $json['data'][]=$objeto;

    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='venta_mes'){
    $venta-> venta_mes();
    $json=array();
    foreach($venta->objetos as $objeto){
        $json[]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
?>