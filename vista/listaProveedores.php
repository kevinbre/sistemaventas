<?php
session_start();
if($_SESSION['usuarioTipo']==1){
include_once 'layouts/header.php';
?>
<!-- Codigo -->


  <title>NAYIK | Listado de Proveedores</title>

<?php include_once 'layouts/nav.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header bg-dark">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de Proveedores</h1>
          </div>        
        </div>
      </div><!-- /.container-fluid -->
 
    </section>
  <!-- Modal editar Proveedor -->
<div class="modal fade" id="editar_proveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="card-title">Editar Proveedor</h3>
            <button data-dismiss="modal" aria-label="close" class="close " ></button>
            <span aria-hidden="true" class="float-right bg-primary"></span>
          </div>
            <div class="card-body">
              <form id="form-editar">
            <div class="form-group">
              <label for="nombre">Proveedor</label>
              <input id="edit_nombre"type="text" class="form-control" placeholder="Ingresar Proveedor (Requerido)" required>
            </div>        
            <div class="form-group">
              <label for="telefono">Telefono</label>
              <input id="edit_telefono"type="text" class="form-control" placeholder="Ingresar el Telefono del Proveedor(Requerido)" required>
            </div>
            <div class="form-group">
              <label for="direccion">Dirección</label>
              <input id="edit_direccion"type="text" class="form-control" placeholder="Ingresar la Dirección del Proveedor" >
            </div>
              <input type="hidden" id="id_edit_proveedor">
            </div>
              <div class="card-footer">
          <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
          <button type="button" data-dismiss="modal" class="btn btn-danger float-right m-1">Cancelar</button>
          
            </form>
          </div>
        </div>
      </div>
    </div>
</div>   
   <!-- Fin Modal Editar Proveedores -->
   <!-- Modal Agregar Proveedor -->
<div class="modal fade" id="modal-crear-proveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="card-title">Agregar Proveedores</h3>
            <button data-dismiss="modal" aria-label="close" class="close " ></button>
            <span aria-hidden="true" class="float-right bg-primary"></span>
          </div>
            <div class="card-body">
            <form id="form-crear-proveedor" action="" method="post" autocomplete="off">
            
            <div class="form-group">
              <label for="nombre_proveedor">Proveedor</label>
              <input type="text" placeholder="Proveedor (Requerido)" name="nombre" id="nombre_proveedor" class="form-control" required>
            </div>            
            <div class="form-group">
              <label for="telefono_proveedor">Telefono</label>
              <input type="text" placeholder="Ingrese el telefono del Proveedor (Requerido)" name="telefono_proveedor" id="telefono_proveedor" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="direccion_proveedor">Dirección</label>
              <input type="text" placeholder="Ingrese la dirección del proveedor" name="direccion_proveedor" id="direccion_proveedor" class="form-control">
            </div>            
          <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
          <button type="button" id="cancelar" data-dismiss="modal" class="btn btn-danger float-right m-1">Cancelar</button>
          
            </form>
          </div>
        </div>
      </div>
    </div>
</div>   
   <!-- Fin Modal Agregar Proveedor -->


    <!-- Contendeor -->
    <section class="content" style="margin-top:100px;">
    <div class="container">
       <div class="row">
           <div class="col-lg-12">  
           
            <div id="" class="dataTables_filter">
            <div class=""> 
            <button class="btn btn-dark float-left btn-sm" data-toggle="modal" data-target="#modal-crear-proveedor"><i class="fas fa-user-plus "></i> Agregar Proveedor</button>           
            <button class="btn btn-default btn-sm float-right"><i class="fas fa-search"></i></button>
            <input id="buscar_proveedor" type="text "class ="buscar_proveedores float-right">
            <div class="dataTables_filter-append"></div>
            
            </div>
           
            <table id="tabla_proveedores" data-order='[[ 5, "asc" ]]' data-page-length='25' class="display table table-sm table-striped table-hover bg-dark"> 
           
            <thead class="text-center bg-primary" >
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Dirección</th>                     
            <th>Acciones</th>
            </thead>                     
           
            <tbody id="lista_proveedores" class="text-center">              
      
            </tbody>
            <tfoot>
         </tfoot>
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
 <script src="../js/paginador.js"></script>

<script type="text/javascript" src="../js/proveedores.js"></script>
<script type="text/javascript" src="../js/datatables.min.js"></script>

