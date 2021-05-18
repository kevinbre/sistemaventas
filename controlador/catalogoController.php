<?php 


include_once '../modelo/catalogo.php';
$catalogo = new Catalogo();


if($_POST['funcion']=='producto_buscar_catalogo'){    
    $catalogo->buscar_catalogo();    
    $json=array();
    foreach ($catalogo->objetos as $objeto){           
        
        $json['data'][]=$objeto;
    }
    
    $jsonstring =json_encode($json);
    echo $jsonstring;
    } 
//Borrar Producto
if($_POST['funcion'] == 'borrar'){
    $id = $_POST['id'];
    $catalogo->borrar_producto($id);    
} 
    ?>