<?php 


include '../modelo/materiaprima.php';
$materiaprima = new MateriaPrima();

session_start();

// //Crear Materia Prima
// if($_POST['funcion']=='crear_materiaprima'){  
//     $nombre = $_POST ['nombre'];     
//     $medicion = $_POST['medicion'];   
//     $existencia = $_POST['existencia']; 
//     $proveedor = $_POST['proveedor'];   

//     $materiaprima->crear($nombre,$medicion,$existencia,$proveedor);
// }

//Crear Materiaprima    
if($_POST['funcion']=='registrar_materiaprima'){
    $nombre = $_POST ['nombre'];     
    $medicion = $_POST['medicion'];   
    $existencia = $_POST['existencia']; 
    $proveedor = $_POST['proveedor']; 
    $materiaprima->crear($nombre,$medicion,$existencia,$proveedor);    
    $materiaprima->ultima_materiaprima();
     foreach ($materiaprima->objetos as $objeto){
         $id_materiaprima = $objeto->id_materiaprima;
         $id_proveedor = $objeto->ultimoproveedor;        
         $materiaprima->crear_materiaprima($id_materiaprima, $id_proveedor);   
             
     }
    }



//Buscar Materia Prima
if($_POST['funcion']=='materiaprima_buscar'){    
    $materiaprima->buscar_materiaprima();    
    $json=array();
    foreach ($materiaprima->objetos as $objeto){     
     
        
        $json[]=array(            
            'id'=> $objeto -> id_materiaprima,
            'nombre'=> $objeto -> nombre_materiaprima,
            'proveedor' => $objeto -> proveedor,
            'proveedorid' => $objeto -> id_proveedor,                         
            'medicion' => $objeto -> medicion_materiaprima,         
            'existencia'=> $objeto -> existencia_materiaprima,
            
        );
    }
    
    $jsonstring =json_encode($json);
    echo $jsonstring;
    } 

//Editar materiaprima   
if($_POST['funcion']=='editar_materiaprima'){
    $id = $_POST ['id'];   
    $nombre = $_POST['nombre'];
    $medicion = $_POST['medicion']; 
    $existencia = $_POST['existencia'];     
    $materiaprima->editar($id, $nombre, $medicion, $existencia);
}
  
//Borrar materiaprima
if($_POST['funcion'] == 'borrar'){
    $id = $_POST['id'];
    $materiaprima->borrar($id);    
} 

//Buscar ID
if($_POST['funcion']=='buscar_id'){    
    $id=$_POST['id_materiaprima'];
    $materiaprima->buscar_id($id);    
    $json=array();
    foreach ($materiaprima->objetos as $objeto){ 
        $materiaprima->buscar_stock($objeto->id_materiaprima);
        foreach($materiaprima->objetos as $obj){
            $total = $obj->total;
        }
        $json[]=array(            
            'id'=> $objeto -> id_materiaprima,
            'nombre'=> $objeto -> nombre_materiaprima,
            'medicion' => $objeto -> medicion_materiaprima, 
            'existencia'=> $objeto -> existencia_materiaprima,
                        
        );
    }
    
    $jsonstring =json_encode($json[0]);
    echo $jsonstring;
    }
    //Traer materiasprimas
    if($_POST['funcion']=='traer_materiasprimas'){
       $html="";
        $materiasprimas=json_decode($_POST['materiasprimas']);
        foreach($materiasprimas as $resultado){
            $materiaprima->buscar_id($resultado->id);
            foreach ($materiaprima->objetos as $objeto ) {
                $cantidad = $objeto->cantidad;
                $precio = $objeto -> precio;
                $html.="
                <tr materiaprimaId='$objeto->id_materiaprima'>                                   
                                        <td>$objeto->nombre_materiaprima</td>                                       
                                        <td>$objeto->existencia_materiaprima</td>                                         
                                        <td>
                                        </td>
                                        <input type='number' min='1' class='form-control costo_materiaprima' value='$resultado->costo' style='width:150px;display: inline-block;' placeholder='0'>
                                        <td>
                                        <input type='number' min='1' class='form-control cantidad_materiaprima' value='$resultado->cantidad' style='width:150px;display: inline-block;' placeholder='0'>
                                        </td>
                                        <td class='subtotales'>
                                        <h5>$$subtotal</h5>
                                        </td>
                                        <td><button class='borrar-materiaprima-carrito btn btn-danger'><i class='fas fa-times-circle'></i></button></td>
                                    </tr>
                ";
                
            }     
           
            
        }
        echo $html;
        
    } 

       //materiaprima Stock

       if($_POST['funcion']=='stock_verificar'){
        $error=0;
        $materiasprimas=json_decode($_POST['materiasprimas']);
        foreach ($materiasprimas as $objeto) {
            $materiaprima->buscar_stock($objeto->id);
            foreach ($materiaprima->objetos as $obj) {
                $total=$obj->total;
            }
            if($total>=$objeto->cantidad && $objeto->cantidad>0){
                $error=$error+0;    
            }else{
                    $error=$error+1;
        }
    }
    echo $error;
}

?>
