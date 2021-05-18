<?php
include_once '../modelo/categorias.php';
$categoria = new Categoria();
//Rellenar Categorias
if($_POST['funcion'] == "rellenar_categorias"){
    $categoria->rellenar_categorias(); 
    $json = array();
    foreach ($categoria->objetos as $objeto){
        $json[]=array(
            'id'=>$objeto->id_categoria,
            'nombre'=>$objeto->nombre_categoria
        );
       
    }  
    $jsonstring=json_encode($json);
    echo $jsonstring; 
} 


?>