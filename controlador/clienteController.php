<?php 

include '../modelo/cliente.php';
$cliente = new Cliente();
//Crear Cliente    
if($_POST['funcion']=='crear_cliente'){
    $nombre = $_POST ['nombre'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $telefono= $_POST['telefono'];
    $direccion= $_POST['direccion'];
    $cliente->crear($nombre,$dni,$email,$telefono,$direccion);
    }
//Buscar Cliente
if($_POST['funcion']=='cliente_buscar'){    
    $cliente->buscar_cliente();
    $json=array();
    foreach ($cliente->objetos as $objeto){
        $json[]=array(
            'id'=> $objeto -> id_cliente,
            'nombre'=> $objeto -> nombre_cliente,
            'dni'=> $objeto -> dni_cliente,
            'email'=> $objeto -> email_cliente,
            'telefono'=> $objeto -> telefono_cliente,
            'direccion'=> $objeto -> direccion_cliente,
        );
    }
    $jsonstring =json_encode($json);
    echo $jsonstring;
    } 
//Editar Cliente    
if($_POST['funcion']=='editar_cliente'){
    $id = $_POST ['id'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email= $_POST['email'];
    $direccion= $_POST['direccion'];
    $cliente->editar($id, $nombre,$telefono,$email,$direccion);
}   
//Borrar Cliente 
if($_POST['funcion'] == 'borrar'){
    $id = $_POST['id'];
    $cliente->borrar($id);    
} 

if($_POST['funcion'] == 'rellenar_clientes'){
    $cliente -> rellenar_clientes(); 
    $json = array();
    foreach($cliente->objetos as $objeto){
        $json[]=array(
            'id'=>$objeto->id_cliente,
            'nombre'=>$objeto-> nombre_cliente.'  |  '.$objeto->dni_cliente,       
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;   
} 
//Contar Clientes 
if($_POST['funcion'] == 'mostrar_consultas'){
    $cliente ->contar_clientes();
    foreach ($cliente->objetos as $objeto){
        $contar_clientes=$objeto->totalclientes;
    }
    $cliente ->contar_catalogo();
    foreach ($cliente->objetos as $objeto){
        $contar_catalogo=$objeto->totalproductos;
    }
    $cliente ->contar_ventas();
    foreach ($cliente->objetos as $objeto){
        $contar_ventas=$objeto->totalventas;
    }
    $cliente ->contar_compras();
    $json=array();
    foreach ($cliente->objetos as $objeto){
        $conta_compras=$objeto->totalcompras;
                $json[]= array(  
                'totalclientes'=>$contar_clientes, 
                'totalproductos'=>$contar_catalogo,
                'totalventas'=>$contar_ventas,   
                'totalcompras'=>$objeto->totalcompras
                     
                 );   
      
}
$jsonstring =json_encode($json[0]);
echo $jsonstring;
} 
      


?>

