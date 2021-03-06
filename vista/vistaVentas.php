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
          <h1>Registro de Ventas</h1>           
          </div>        
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <!-- Modal Detalle Venta -->
  <div class="modal fade transparencia" id="vista-venta" tabindex="-1" style="opacity: .8;" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card" >
          <div class="card-header bg-primary">
            <h4 class="card-title">Detalle de venta</h4>
            <button data-dismiss="modal" aria-label="close" class="close " ></button>
            <span aria-hidden="true" class="float-left bg-primary" style="text-align:center"></span>
          </div>
            <div class="col-sm-12">
            <div class="card-body">              
            <div class="form-group" style="margin-top:0%;margin-bottom:0%">
             
              <label for="codigo_venta" >Codigo venta</label>              
              <span id="codigo_venta"></span>
                         
          </div>
            </div>                         
            <div class="form-group text-center" style="margin-top:0%;margin-bottom:0%">
              <label for="fecha_venta"> Fecha </label>
              <p id="fecha_venta"></p>
            </div>
            <hr style="border-color:#64a8ec;width: 50%;"></hr>          
                        
            <div class="form-group text-center">
              <label for="cliente_venta" style="margin-top:0%;margin-bottom:0%">Cliente</label>
              <p id="cliente_venta"></p>
            </div>
            <hr style="border-color:#64a8ec;width: 50%;"></hr>         
                       
            <!-- <div class="form-group text-center">
              <label for="dni_venta">DNI</label>
              <p id="dni_venta"></p>
            </div>
            <hr style="border-color:#64a8ec;width: 50%;"></hr> -->
           
                       
            <div class="form-group text-center" style="margin-top:0%;margin-bottom:0%">
              <label for="total_sd">Email</label>             
              <p id="email_venta"></p>            
            </div>
            <hr style="border-color:#64a8ec;width: 50%;" ></hr>
            
                    
            <div class="form-group text-center" style="margin-top:0%;margin-bottom:0%">
              <label for="descuento_venta">Direcci??n</label>
              <p id="direccion_venta"></p>
            </div>
            <hr style="border-color:#64a8ec;width: 50%;"></hr>
          
                       
            <div class="form-group text-center" style="margin-top:0%;margin-bottom:0%">
              <label for="total_venta">Telefono</label>
              <p id="telefono_venta"style="text-align:center;"></p>
            </div> 
            <!-- <hr style="border-color:#64a8ec;width: 50%;"></hr> -->
          
                        
            <!-- <div class="form-group text-center">
              <label for="total_venta" >Total</label>
              <p id="total_venta"></p>
            </div>  -->
              
            <input type="hidden" id="id_venta">
            </div>
            <table class="table table-hover text-nowrap">
                   <thead class="bg-primary text-center">
                      <tr>                      
                        <th>Modelo</th>
                        <th>Categoria</th>
                        <th>Cantidad</th>
                        <th>Pecio</th>
                      </tr>
                  
                   </thead>
                   <tbody id="registros" class="text-center"></tbody>
                 </table>  
            
</div>       
   
          </div>
        </div> 
     
    </div>

   <!-- Fin Modal Detalle Venta -->
      <!-- Contendeor -->
      <div class="content">
      <section class="content" style="margin-top:100px;">
    <div class="container">
       <div class="row">
           <div class="col-lg-12"> 
            <div id="" class="dataTables_filter">
             
            <div class="dataTables_filter-append"><button class="btn btn-default btn-sm float-right"><i class="fas fa-search"></i></button>  </div>
            
            </div>
           
        <div class= "contenedor arreglotabla" style="vertical-align:middle;">
      <table id="tabla_venta" class=" table table-hover table-sm bg-dark table-striped" style="width:100%, vertical-align:middle;">
        <thead class="bg-primary text-center">              
                <th>Fecha</th>
                <th>Cliente</th>
                <th>DNI</th>               
                <th>Total Venta</th>
                <th>Acci??n</th>          
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
<script src="../js/ventas.js"></script>