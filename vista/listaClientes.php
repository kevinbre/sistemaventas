<?php
session_start();
if($_SESSION['usuarioTipo']==1){
include_once 'layouts/header.php';
?>
<!-- Codigo -->


  <title>NAYIK | Listado de Clientes</title>

<?php include_once 'layouts/nav.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header bg-dark">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de Clientes</h1>
          </div>        
        </div>
      </div><!-- /.container-fluid -->
 
    </section>
  <!-- Modal editar cliente -->
<div class="modal fade" id="editar_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="card-title">Editar Cliente</h3>
            <button data-dismiss="modal" aria-label="close" class="close " ></button>
            <span aria-hidden="true" class="float-right bg-primary"></span>
          </div>
            <div class="card-body">
              <form id="form-editar">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input id="edit_nombre"type="text" class="form-control" placeholder="Ingresar nombre (Requerido)" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input id="edit_email"type="text" class="form-control" placeholder="Ingresar email">
            </div>
            <div class="form-group">
              <label for="telefono">Telefono</label>
              <input id="edit_telefono"type="text" class="form-control" placeholder="Ingresar telefono (Requerido)" required>
            </div>
            <div class="form-group">
              <label for="direccion">Dirección</label>
              <input id="edit_direccion"type="text" class="form-control" placeholder="Ingresar dirección" >
            </div>
              <input type="hidden" id="id_edit_cliente">
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
   <!-- Fin Modal Editar Cliente -->
   <!-- Modal Agregar Cliente -->
<div class="modal fade" id="modal-crear-cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="card-title">Agregar Cliente</h3>
            <button data-dismiss="modal" aria-label="close" class="close " ></button>
            <span aria-hidden="true" class="float-right bg-primary"></span>
          </div>
            <div class="card-body">
            <form id="form-crear-cliente" action="" method="post" autocomplete="off">
            
            <div class="form-group">
              <label for="nombre_cliente">Nombre</label>
              <input type="text" placeholder="Nombre del cliente (Requerido)" name="nombre" id="nombre_cliente" class="form-control" required>
            </div>            
            <div class="form-group">
              <label for="dni_cliente">DNI</label>
              <input type="text" placeholder="Ingrese el DNI del cliente (Requerido)" name="dni" id="dni_cliente" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="email_cliente">Email</label>
              <input type="text" placeholder="Ingrese el Email del cliente" name="email" id="email_cliente" class="form-control">
            </div>
            <div class="form-group">
              <label for="telefono_cliente">Telefono</label>
              <input type="text" placeholder="Ingrese el Telefono del cliente (Requerido)" class="form-control" name="telefono" id="telefono_cliente" required>
            </div>
            <div class="form-group">
              <label for="direccion_cliente">Dirección</label>
              <input type="text" placeholder="Ingrese la Dirección del cliente" class="form-control" name="direccion" id="direccion_cliente">
            </div>
          <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
          <button type="button" id="cancelar" data-dismiss="modal" class="btn btn-danger float-right m-1">Cancelar</button>
          
            </form>
          </div>
        </div>
      </div>
    </div>
</div>   
   <!-- Fin Modal Agregar Cliente -->


    <!-- Contendeor -->
    <section class="content" style="margin-top:100px;">
    <div class="container">
       <div class="row">
           <div class="col-lg-12">  
           
            <div id="" class="dataTables_filter">
            <div class=""> 
            <button class="btn btn-dark float-left btn-sm" data-toggle="modal" data-target="#modal-crear-cliente"><i class="fas fa-user-plus "></i> Agregar Cliente</button>           
            <button class="btn btn-default btn-sm float-right"><i class="fas fa-search"></i></button>
            <input id="buscar_clientes" type="text "class ="buscar_clientes float-right">
            <div class="dataTables_filter-append"></div>
            
            </div>
           
            <table id="tablaClientes" data-order='[[ 5, "asc" ]]' data-page-length='25' class="display table table-sm table-striped table-hover bg-dark"> 
           
            <thead class="text-center bg-primary" >
            <th>Nombre</th>
            <th>DNI</th>
            <th>Telefono</th>
            <th class="emailocultar">Email</th>
            <th class="emailocultar">Dirección</th>
            <th>Acciones</th>
            </thead>                     
           
            <tbody id="lista_clientes" class="text-center">              
            <tr>
            <td class="emailocultar"></td>
            </tr>
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
 
<script type="text/javascript" src="../js/cliente.js"></script>
<script type="text/javascript" src="../js/datatables.min.js"></script>

