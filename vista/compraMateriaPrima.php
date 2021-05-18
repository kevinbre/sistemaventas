<?php
session_start();
if($_SESSION['usuarioTipo']==1){
include_once 'layouts/header.php';
?>
<!-- Codigo -->
  <title>NAYIK | Inicio</title>

<?php include_once 'layouts/nav.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
          
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="margin-top:100px;">

      <!-- Default box -->
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="card-title ">Compra de Materias Primas</h3>
      
        </div>
     <div class="card-body row">
                 
                  <div class="card col-sm-3 p-3">                  
                  
                 
                      <div class="form-group">
                            <label for="proveedor">Proveedor</label>
                            <select id="proveedor" class="form-control" value="null" placeholder="Selecciona un Proveedor" style="width: 100%"></select>
                        </div>
                        <div class="form-group">
                            <label for="producto">Producto</label>
                            <select id="producto" class="form-control producto select2" placeholder="Selecciona un Producto" style="width: 100%"></select>
                        </div>
                      
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input id="cantidad" type="number" class="form-control"  placeholder="Ingresar Cantidad"  required>
                        </div>
                        
                        <div class="form-group">
                            <label for="precio_compra">Precio de compra</label>
                            <input id="precio_compra" type="number" step="any" class="form-control monto"  placeholder="Ingresar precio de Compra" required>
                        </div>
                        <div class="form-group text-right">
                            <button class="agregar-producto btn bg-gradient-success ml-2">Agregar</button>
                        </div>                    
                    
                  </div>
                  <div class="card col-sm-6">
                        <table class="display table table-sm bg-dark table-striped table-hover text-center arreglotabla" style="margin-top:10px">
                            <thead class='bg-primary'>
                                <tr>
                                   
                                    <th>Producto/Medición</th>                                 
                                    <th>Cantidad</th>
                                    <th>Precio</th>                                  
                                    <th>Operación</th>
                                </tr>
                            </thead>
                            <tbody id="registros_compra" class='table-active'>
                            </tbody>             
                        </table>                      
                    </div>
                    <div class="card col-sm-3 p-3">                     
                    <form id="form-crear-compra">
                    <div class="form-group text-center">
                            <label for="fecha_compra">Fecha de compra </label>
                            <input id="fecha_compra"type="date" class="form-control text-center" placeholder="Ingrese fecha de compra" required>
                        </div>  
                        <div class="form-group text-center">
                            <label for="usuario">Usuario</label>
                            <select  id="usuario" class="form-control text-center select2" style="width: 100%"></select>
                        </div>
                        <hr style="border-color:#64a8ec;width: 50%;"></hr>  
                        <div class="form-group text-center">
                            <label for="total">Precio Total </label> <br/>                           
                            <label id ="total"></label>                         
                        </div>                        
                    </form>
                    <button class="crear-compra btn bg-primary text-center" style="margin-top:5px; margin-bottom:10px;">Crear compra</button>
                  </div>
                  
                </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

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


<script src="../js/ingresar_compra.js"></script>
<!-- SweetAlert2 -->
<script src="../js/sweetalert2.min.js"></script>
<script src="../js/select2.js"></script>

