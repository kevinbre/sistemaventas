<?php 


include '../modelo/producto.php';
$producto = new Producto();

session_start();

//Crear Producto
if($_POST['funcion']=='crear_producto'){  
    $sku = $_POST ['sku'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];
    $producto->crear($sku,$nombre,$tipo,$precio);
}
//Buscar Producto
if($_POST['funcion']=='producto_buscar'){    
    $producto->buscar_producto();    
    $json=array();
    foreach ($producto->objetos as $objeto){     
     
        
        $json[]=array(            
            'id'=> $objeto -> id_producto,
            'sku'=> $objeto -> sku_producto,
            'nombre'=> $objeto -> nombre_producto,
            'stock' => $objeto -> stock_producto,            
            'tipo' =>$objeto -> tipo,
            'tipo_id' =>$objeto -> tipo_producto,
            'precio'=> $objeto -> precio_producto,            
        );
    }
    
    $jsonstring =json_encode($json);
    echo $jsonstring;
    } 

   /* //Data Table

    if($_POST['funcion']=='producto_buscar_data'){    
        $producto->buscar_producto_data();    
        $json=array();
        foreach ($producto->objetos as $objeto){           
            
            $json['data'][]=$objeto;
        }
        
        $jsonstring =json_encode($json);
        echo $jsonstring;
        } */


//Editar Producto   
if($_POST['funcion']=='editar_producto'){
    $id = $_POST ['id'];   
    $nombre = $_POST['nombre'];
    $tipo_id = $_POST['tipo_id'];
    $precio = $_POST['precio'];   
    $producto->editar($id, $nombre, $precio, $tipo_id);
} 
//Editar Stock   
if($_POST['funcion']=='modificar_stock'){
    $prod_id = $_POST ['prod_id'];   
    $prod_stock = $_POST['prod_stock'];    
    $producto->editar_stock($prod_id, $prod_stock);
}     
//Borrar Producto
if($_POST['funcion'] == 'borrar'){
    $id = $_POST['id'];
    $producto->borrar($id);    
} 

//Buscar ID
if($_POST['funcion']=='buscar_id'){    
    $id=$_POST['id_producto'];
    $producto->buscar_id($id);    
    $json=array();
    foreach ($producto->objetos as $objeto){ 
        $producto->buscar_stock($objeto->id_producto);
        foreach($producto->objetos as $obj){
            $total = $obj->total;
        }
        $json[]=array(            
            'id'=> $objeto -> id_producto,
            'sku'=> $objeto -> sku_producto,
            'nombre'=> $objeto -> nombre_producto,
            'stock' => $total,            
            'tipo' =>$objeto -> tipo,
            'tipo_id' =>$objeto -> tipo_producto,
            'precio'=> $objeto -> precio_producto, 
                        
        );
    }
    
    $jsonstring =json_encode($json[0]);
    echo $jsonstring;
    }
    //Traer Productos
    if($_POST['funcion']=='traer_productos'){
       $html="";
        $productos=json_decode($_POST['productos']);
        foreach($productos as $resultado){
            $producto->buscar_id($resultado->id);
            foreach ($producto->objetos as $objeto ) {
                if($resultado->cantidad==''){
                    $resultadoCantidad = 0;
                }else{
                    $resultadoCantidad = $resultado->cantidad;
                }
                $subtotal= $objeto->precio_producto*$resultadoCantidad;
                $html.="
                <tr productoId='$objeto->id_producto'  productoPrecio='$objeto->precio_producto'>
                                        <td>$objeto->sku_producto</td>
                                        <td>$objeto->nombre_producto</td>
                                        <td>$objeto->tipo</td>
                                        <td>$objeto->stock_producto</td>                                          
                                        <td>$$objeto->precio_producto</td>
                                        <td>
                                        <input type='number' min='1' class='form-control cantidad_producto' value='$resultado->cantidad' style='width:150px;display: inline-block;' placeholder='0'>
                                        </td>
                                        <td class='subtotales'>
                                        <h5>$$subtotal</h5>
                                        </td>
                                        <td><button class='borrar-producto-carrito btn btn-danger'><i class='fas fa-times-circle'></i></button></td>
                                    </tr>
                ";
                
            }     
           
            
        }
        echo $html;
        
    } 

       //Producto Stock

       if($_POST['funcion']=='stock_verificar'){
        $error=0;
        $productos=json_decode($_POST['productos']);
        foreach ($productos as $objeto) {
            $producto->buscar_stock($objeto->id);
            foreach ($producto->objetos as $obj) {
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
if($_POST['funcion'] == 'rellenar_productos'){
    $producto -> rellenar_productos(); 
    $json = array();
    foreach($producto->objetos as $objeto){        
     $json[]=array(
            'id'=>$objeto->id_materiaprima,
            'nombre'=> $objeto->id_materiaprima.' | '.$objeto-> nombre_materiaprima.' | '.$objeto-> medicion_materiaprima, 
            'existencia'=>$objeto-> existencia_materiaprima      
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;   
} 
if($_POST['funcion'] == 'sumar_total'){
    $id = $_POST ['id'];
    $producto -> sumarTotal($id);
    $json = array();
    foreach($producto->objetos as $objeto){
        $json[]=array( 
            'totalsuma'=>$objeto->totalsuma
        );
       

    }
}

?>
