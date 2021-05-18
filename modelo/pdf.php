<?php 
include_once 'venta.php';
include_once 'ventaProducto.php';

function getHtml($id_venta){
    $venta = new Venta();
    $venta_producto = new VentaProducto();
    $venta ->buscar_id($id_venta);
    $venta_producto -> ver($id_venta);
    $plantilla='
    <body>
    <header class="clearfix">
    <div id="logo">
    <img src="../img/logoavatar.png" width="60" height="60">
    </div>
    <h1>Comprobante de Pago</h1>    
    <div id="company" class="clearfix">
    <div id="negocio">NAYIK Cueros</div>
    <div> Dirección Piagio 367<br /> Rosario, Santa Fe</div>
    <div>(341)5118066</div>
    <div><a href="mailto:contacto@nayik.com.ar">contacto@nayik.com.ar</a></div>
    
    </div>';
   
    foreach($venta->objetos as $objeto){
        $plantilla.='
        
        <div id="project" class="clearfix">
        <div><span>Codigo de Venta </span>'.$objeto->id_venta.'</div>
        <div><span>Cliente </span>'.$objeto->nombre_cliente.'</div>
        <div><span>DNI </span>'.$objeto->dni_cliente.'</div>
        <div><span>Vendedor </span>'.$objeto->usuario_nomyape.'</div>
        <div><span>Fecha y Hora </span>'.$objeto->fecha_venta.'</div>
        </div>';
    }
    $plantilla.='
    </header>
    <main>
    <table>
    <thead>
    <tr class="text-center" style="text-align:center;">
    <th class="service">Código</th>
    <th class="service">Producto</th>
    <th class="service">Categoria</th>
    <th class="service">Cantidad</th>
    <th class="service">Precio/U</th>
    <th class="service">Precio</th>     
    </tr>
    </thead>
    <tbody>';
    foreach($venta_producto->objetos as $objeto){
    
        $plantilla.='
        <tr>
        <td class="servic">'.$objeto->sku_producto.'</td>
        <td class="servic">'.$objeto->nombre_producto.'</td>
        <td class="servic">'.$objeto->nombre_categoria.'</td>
        <td class="servic">'.$objeto->cantidad_producto.'</td>
        <td class="servic">$'.$objeto->precio_producto.'</td>
        <td class="servic">$'.$objeto->precio_producto_venta.'</td>
        </tr>';
    }
    $calculos = new Venta();  
    $calculos2 = new Venta (); 
    $calculos->buscar_id ($id_venta); 
    $calculos2->buscar_productos ($id_venta);  
    
    foreach ($calculos->objetos as $objeto){
        $totalventa = $objeto-> total_venta; 
        foreach ($calculos2 -> objetos as $calc){
        $subtotal = $calc-> subtotal;
        $descuento = $subtotal - $totalventa;

         
    


    $plantilla.='
    <tr>
    <td colspan="5" class="grand total">DESCUENTO</td>
    <td class="grand total">$'.$descuento.'</td>
    </tr>
    <tr>
    <td colspan="5" class="grand total">TOTAL</td>
    <td class="grand total">$'.$totalventa.'</td>
    </tr>
    ';
    
    
}
    }
    $plantilla.='
    </tbody>
    </table>    
     
    <div id="notices" class="margensuperior">
         <div> Garantía y Cambios:</div>
 <div class="notice">Presentar este comprobante de pago en caso de reclamo por fallas en el producto.</div>
    <div class="notice">La garantía solo reconoce fallas de producción.</div>
     <div class="notice">Este comprobante es válido para cambios hasta 7 días después de efectuada la compra.</div>
    
    </div>  
    
    </main>
    <footer>
  
    </footer>
    </body>';

    return $plantilla;
}
    
      

?>











