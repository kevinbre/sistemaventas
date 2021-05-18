<?php
session_start();
if($_SESSION['usuarioTipo']==1){
include_once 'layouts/header.php';
?>
<!-- Codigo -->
  <title>NAYIK | Listado ventas</title>

<?php include_once 'layouts/nav.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header bg-dark">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"> 
          <h1>Registro de Compras</h1>           
          </div>        
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <!-- Modal Detalle Compra -->
  <div class="modal fade transparencia" id="vista-compra" tabindex="-1" style="opacity: .8;" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card" >
          <div class="card-header bg-primary">
            <h4 class="card-title">Detalle de Compra</h4>
            <button data-dismiss="modal" aria-label="close" class="close " ></button>
            <span aria-hidden="true" class="float-left bg-primary" style="text-align:center"></span>
          </div>
            <div class="col-sm-12">
            <div class="card-body">              
            <div class="form-group" style="margin-top:0%;margin-bottom:0%">
             
              <label for="codigo_venta" >Codigo Compra</label>              
              <span id="codigo_compra"></span>
                         
          </div>
            </div>                         
            <div class="form-group text-center" style="margin-top:0%;margin-bottom:0%">
              <label for="fecha_compra"> Fecha </label>
              <p id="fecha_compra"></p>
            </div>
            <hr style="border-color:#64a8ec;width: 50%;"></hr>        
         
            <div class="form-group text-center">
              <label for="nombre_proveedor">Proveedor</label>
              <p id="nombre_proveedor"></p>
            </div>
            <hr style="border-color:#64a8ec;width: 50%;"></hr>          
    
                    
            <div class="form-group text-center" style="margin-top:0%;margin-bottom:0%">
              <label for="descuento_venta">Dirección Proveedor</label>
              <p id="direccion_proveedor"></p>
            </div>
            <hr style="border-color:#64a8ec;width: 50%;"></hr>
          
                       
            <div class="form-group text-center" style="margin-top:0%;margin-bottom:0%">
              <label for="telefono_proveedor">Telefono Proveedor</label>
              <p id="telefono_proveedor"style="text-align:center;"></p>
            </div> 
            <!-- <hr style="border-color:#64a8ec;width: 50%;"></hr> -->
          
                        
            <!-- <div class="form-group text-center">
              <label for="total_venta" >Total</label>
              <p id="total_venta"></p>
            </div>  -->
              
            <input type="hidden" id="id_compra">
            </div>
            <table class="table table-hover text-nowrap">
                   <thead class="bg-primary text-center">
                      <tr>                      
                        <th>Materia Prima</th>
                        <th>Medición</th>                       
                        <th>Cantidad</th>
                        <th>Pecio</th>
                      </tr>
                  
                   </thead>
                   <tbody id="registros_compras" class="text-center">
                   </tbody>
                 </table>  
            
</div>       
          
           
          </div>
        </div> 
             
    </div>

   <!-- Fin Modal Detalle Venta -->
      <!-- Contendeor -->
      <section class="content" style="margin-top:100px;">
    <div class="container">
       <div class="row">
           <div class="col-lg-12">  
          
            <div id="" class="dataTables_filter">
            <div class=""> 
            <!-- <button class="btn btn-dark float-left btn-sm" href="../vista/catalogoLista.php"><i class="fas fa-user-plus "></i> Catalogo</button>            -->
                      
            <div class="dataTables_filter-append"><button class="btn btn-default btn-sm float-right"><i class="fas fa-search"></i></button>  </div>
            
            </div>
           
        <div class= "contenedor arreglotabla">
      <table id="tabla_compras" class="display table table-hover table-sm bg-dark text-nowrap" style="width:100%">
        <thead class="bg-primary text-center">
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Proveedor</th>
                <th>Total</th> 
                <th>Acción</th>                        
            </thead>               
            <tbody class="text-center">              
      
            </tbody>
            <tfoot>
         </tfoot>
         </div>
</div>
            </div>
        </div>
       </div>
    </table>
  </section> 
           
     
      </div>
      

      
  

<?php include_once 'layouts/footer.php';?>

<!-- Fin Codigo -->
<?php
}
else{
    header('Location: ../login.php');
}
?>
<script src="../js/datatables.min.js"></script>
<script src="../js/compras.js"></script>