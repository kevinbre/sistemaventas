<?php 

include_once '../modelo/compras.php';
include_once '../modelo/existencia.php';
include_once '../modelo/conexion.php';
require_once '../vendor/autoload.php';
$existencia = new Existencia();
$compras = new Compras();
//Crear Cliente    
if($_POST['funcion']=='registrar_compra'){
   $descripcion = json_decode($_POST['descripcionString']);
   $productos = json_decode($_POST['productosString']); 
   var_dump($descripcion) ;  
   var_dump($productos) ; 
   $compras->crear($descripcion->fecha_compra,$descripcion->proveedor,$descripcion->usuario,$descripcion->total);
   $compras->ultima_compra();
    foreach ($compras->objetos as $objeto){
        $id_compra = $objeto->ultima_compra;
    }
    echo $id_compra;
    foreach ($productos as $prod){
    $existencia->crear_existencia($id_compra, $prod->id,  $prod->cantidad, $prod-> precio_compra, );   
            
    }
     
  
    
}
//Crear Cliente    
if($_POST['funcion']=='listar_compras'){
    $compras->listar_compras();
    $contador=0;
    foreach ($compras->objetos as $objeto){
        $contador++;
        $json[]=array(
            'numeracion' => $contador,
            'id_compra' => $objeto-> id_compra,
            'fecha_compra' => $objeto->fecha_compra,
            'usuario' => $objeto-> usuario_nomyape,
            'proveedor' => $objeto->nombre_proveedor,
            'direccionprov' => $objeto-> direccion_proveedor,
            'telefonoprov' => $objeto-> telefono_proveedor,
            'total' => $objeto -> total_compra,
           
            
        );
    }
    $jsonstring= json_encode ($json);
    echo $jsonstring;
}

if($_POST['funcion']=='imprimir'){
    $id_compra = $_POST['id'];
    $compras->obtenerDatos($id_compra);
    var_dump($compras);
    foreach ($compras->objetos as $objeto){      
        $id_compra=$objeto->id_compra;
        $fecha_compra=$objeto->fecha_compra;
        $total=$objeto->total_compra;
        $usuario=$objeto->usuario_nomyape;
        $proveedor=$objeto->nombre_proveedor;
        $proveedortel=$objeto->telefono_proveedor;
        $proveedordir=$objeto->direccion_proveedor;
        $nombremat=$objeto->nombre_materiaprima;
        $medicionmat=$objeto->medicion_materiaprima;
        $preciomat=$objeto->precio_mp;
    }
}
    // $existencia-> ver($id_compra);
    // $plantilla='
    // <body>
    // <header class="clearfix">
    // <div id="logo">
    // <img src="../img/logoavatar.png" width="60" height="60">
    // </div>
    // <h1>Registro de Compra</h1>    
    // <div id="company" class="clearfix">
    // <div id="negocio">'.$objeto->nombre_proveedor.'</div>
    // <div>'.$objeto->direccion_proveedor.' </div>
    // <div>'.$objeto->telefono_proveedor.'</div>
   
    
    // </div>';
   
    // foreach($compras->objetos as $objeto){
    //     $plantilla.='
        
    //     <div id="project" class="clearfix">
    //     <div><span>Codigo de Venta </span>'.$objeto->id_compra.'</div>
    //     <div><span>Usuario </span>'.$objeto->usuario_nomyape.'</div>        
    //     <div><span>Proveedor </span>'.$objeto->nombre_proveedor.'</div>
    //     <div><span>Fecha </span>'.$objeto->fecha_compra.'</div>
    //     </div>';
    // }
    // $plantilla.='
    // </header>
    // <main>
    // <table>
    // <thead>
    // <tr class="text-center" style="text-align:center;">
    // <th class="service">Porducto</th>
    // <th class="service">Medición</th>
    // <th class="service">Cantidad</th> 
    // <th class="service">Precio Unitario</th>
    // <th class="service">Sub Total</th>       
    // </tr>
    // </thead>
    // <tbody>';
    // foreach($compras->objetos as $objeto){
    //     $preciomp = $objeto-> precio_mp; 
    //     $cantidad = $objeto-> cantidad_mp;
    //     $preciou = $preciomp / $cantidad;   
     
    
    //     $plantilla.='
    //     <tr>
    //     <td class="servic">'.$objeto->nombre_materiaprima.'</td>
    //     <td class="servic">'.$objeto->medicion_materiaprima.'</td>
    //     <td class="servic">'.$objeto->cantidad_mp.'</td>
    //     <td class="servic">$'.$preciou.'</td>
    //     <td class="servic">$'.$objeto->precio_mp.'</td>
       
    //     </tr>';
    // }
   

    // $plantilla.='    
    // <tr>
    // <td colspan="4" class="grand total">TOTAL</td>
    // <td class="grand total">$'.$objeto->total_compra.'</td>
    // </tr>
    // ';
    
    
    // $plantilla.='
    // </tbody>
    // </table>   
     
  
    
    // </main>
    // <footer>
  
    // </footer>
    // </body>';
    
    // $css = file_get_contents("../css/pdf.css");
    // $mpdf = new \Mpdf\Mpdf();
    // $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
    // $mpdf->WriteHTML($plantilla, \Mpdf\HTMLParserMode::HTML_BODY);
    // $mpdf->Output("../pdf_compra/pdf-compra-".$id_compra.".pdf","f");
    
 
    // }
    

?>

