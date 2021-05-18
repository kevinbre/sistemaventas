<?php

include_once '../modelo/usuario.php';
$usuario = new usuario();
if($_POST['funcion']=='buscar_usuario'){
    $json=array();
    $usuario->obtener_datos($_POST['dato']);  
    foreach($usuario->objetos as $objeto){           
        $json[]=array(
            'nombre_usuario'=>$objeto->nombre_usuario,
            'nomyape_usuario'=>$objeto->usuario_nomyape,
            'rol_usuario'=>$objeto->nombre_rol,
            'usuario_email'=>$objeto->usuario_email,
            
        );
    }
    $jsonstring =json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion']=='cambiar_contra'){
    $id_usuario=$_POST['id_usuario'];
    $actual=$_POST['actual'];   
    $nueva=$_POST['nueva'];
    $confirmar=$_POST['confirmar'];
    $usuario->cambiar_contra($id_usuario,$actual,$nueva,$confirmar);

}

?>