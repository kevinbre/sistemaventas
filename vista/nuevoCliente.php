
<?php
session_start();
if($_SESSION['usuarioTipo']==1){
include_once 'layouts/header.php';
?>
<!-- Codigo -->
  <title>NAYIK | Agregar Cliente</title>

<?php include_once 'layouts/nav.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header bg-dark">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nuevo Cliente</h1>
          </div>         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="margin-top:25px;">      
      <div class="row">
     <div class="col-lg-6 m-auto">
       <div class="card">
         <div class="card-header bg-primary">
           Nuevo Cliente
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
            
             <input type="submit" value="Guardar Cliente" class="btn btn-primary">
           </form>
         </div>
       </div>
     </div>
   </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

<?php include_once 'layouts/footer.php';?>

<!-- Fin Codigo -->
<?php
}
else{
    header('Location: ../login.php');
}
?>
<script src="../js/cliente.js"></script>