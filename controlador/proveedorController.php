<?php 

include '../modelo/proveedor.php';
$proveedor = new Proveedor();
//Crear Proveedor    
if($_POST['funcion']=='crear_proveedor'){
    $nombre = $_POST ['nombre'];  
    $telefono= $_POST['telefono'];
    $direccion= $_POST['direccion'];
    $proveedor->crear($nombre,$telefono,$direccion);
    }
//Buscar Proveedor
if($_POST['funcion']=='proveedor_buscar'){    
    $proveedor->buscar_proveedor();
    $json=array();
    foreach ($proveedor->objetos as $objeto){
        $json[]=array(
            'id'=> $objeto -> id_proveedor,
            'nombre'=> $objeto -> nombre_proveedor,          
            'telefono'=> $objeto -> telefono_proveedor,
            'direccion'=> $objeto -> direccion_proveedor,
        );
    }
    $jsonstring =json_encode($json);
    echo $jsonstring;
    } 
//Editar Proveedor    
if($_POST['funcion']=='editar_proveedor'){
    $id = $_POST ['id'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono']; 
    $direccion= $_POST['direccion'];
    $proveedor->editar($id, $nombre,$telefono,$direccion);
}   
//Borrar Proveedor
if($_POST['funcion'] == 'borrar'){
    $id = $_POST['id'];
    $proveedor->borrar($id);    
} 

// if($_POST['funcion'] == 'rellenar_productos'){   
//     $proveedor -> rellenar_productos(); 
//     $json = array();
//     foreach($proveedor->objetos as $objeto){
//         $json[]=array(
//             'idprov'=>$objeto->id_proveedor,
//             'nombreprov'=>$objeto-> nombre_proveedor,
//             'idmateprov'=>$objeto-> id_mp_pv,
//             'provid'=>$objeto-> id_prov,
//             'mateid'=>$objeto->id_materiaprima,            
//             'matenombre'=>$objeto-> nombre_materiaprima,
//             'mateprovmp' =>$objeto ->id_prov_mp          
     
//         );
//     }
//     $jsonstring = json_encode($json);
//     echo $jsonstring;   
// } 

if($_POST['funcion'] == 'relleno_automatico'){
    
    $id = $_POST['valor'];
    $proveedor -> relleno_automatico($id); 
    $json = array();
    foreach($proveedor->objetos as $objeto){
        $json[]=array(
            'id'=>$objeto->id_materiaprima .' | '.$objeto->id_prov ,                    
            'nombre'=> $objeto->id_materiaprima.' - '.$objeto-> nombre_materiaprima.' - '.$objeto-> medicion_materiaprima, 
            'existencia'=>$objeto-> existencia_materiaprima       
           
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;   
} 



if($_POST['funcion'] == 'rellenar_proveedores'){
    $proveedor -> rellenar_proveedores();    
    $json = array();
    foreach($proveedor->objetos as $objeto){
        $json[]=array(
            'id'=>$objeto->id_proveedor,
            'nombre'=>$objeto-> nombre_proveedor,
                    );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;   
} 


if($_POST['funcion'] == 'rellenar_usuario'){
    $proveedor -> rellenar_usuario(); 
    $json = array();
    foreach($proveedor->objetos as $objeto){
        $json[]=array(
            'id'=>$objeto->id_usuario,
            'nombre'=>$objeto-> usuario_nomyape,       
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;   
} 

?>

