
<?php
session_start();
if($_SESSION['usuarioTipo']==1){
include_once 'layouts/header.php';
?>
<!-- Codigo -->
  <title>NAYIK | Agregar Producto</title>

<?php include_once 'layouts/nav.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header bg-dark">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Agregar nuevo Producto</h1>
          </div>         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="margin-top:25px;">      
      <div class="row">
     <div class="col-lg-6 m-auto">
       <div class="card">
         <div class="card-header bg-primary" >
           Nuevo Producto
         </div>
         <div class="card-body">
           <form id="form-crear-producto" action="" method="post" autocomplete="off">
             
             <div class="form-group">
               <label for="sku_producto">SKU DE PRODUCTO</label>
               <input type="text" placeholder="SKU#" name="codigo" id="sku_producto" class="form-control">
             </div>
             <div class="form-group">               
               </select>
             </div>
             <div class="form-group">
               <label for="producto_producto">Producto</label>
               <input type="text" placeholder="Ingrese nombre del producto" name="producto" id="nombre_producto" class="form-control">
             </div>
             <div class="form-group">
               <label for="tipo_producto">Tipo</label>
               <input type="text" placeholder="Ingrese tipo de producto" name="producto" id="tipo_producto" class="form-control">
             </div>
             <div class="form-group">
               <label for="precio_producto">Precio</label>
               <input type="text" placeholder="Ingrese precio" class="form-control" name="precio_producto" id="precio_producto">
             </div>
            
             <input type="submit" value="Guardar Producto" class="btn btn-primary">
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
<script src="../js/producto.js"></script>