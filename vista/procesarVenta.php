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


    <section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                    </div>
                    <div class="card-body p-0">
                        <header>
                            <div class="logo_cp">
                                <img src="../img/logoavatar.png" width="100" height="100">
                            </div>
                            <h1 class="text-center">Procesar Venta</h1>    
                                                  
                                <div class="form-group row">                  
                                <div class="col-md-12">                                  
                                    <br><div style="text-align:center;">
                                    <div class="datos_cp">                     
                                    <span>Cliente </span>
                                    </div>                                    
                                    <div class="arreglado" style="font-size:20px;">
                                    <div class="col-md-12 row arreglado" style="text-align:center;">                                    
                                    <select id="cliente" class="form-control select2"></select>                                      
                                    </div>    
                                    </div> 
                                    </div>   
                                                       
                                    <div class="col-md-12">
                                    <div class="datos_cp">
                                    <div style="text-align:center;">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-crear-cliente"><i class="fas fa-user-plus "></i> Nuevo Cliente</button>       
                                    <br>
                                    <br>                            
                                    
                                    <h5 class="select-ventas" style="font-size:16px;"><b><i style="padding-right:25px;">Vendedor</i></b> <?php echo $_SESSION["usuario_nomyape"]?></h5>
                                    <button id="actualizar" class="btn btn-success" style="float:right;margin-right: 80px;"><i class="fas fa-redo-alt"></i></button>
                                    </div>    
                                    </div>
                                    </div>
                                </div>
                                    </div> 
                            </div>
                        </header>
                        
                        
                        <div id="cp" class="card-body p-0">
                            <table class="compra table table-hover text-nowrap table-striped bg-dark align-middle" style="width:100%;text-align:center;">
                                <thead class="text-center bg-primary" style="color:white;">
                                    <tr class="text-center ">
                                        <th scope="col">SKU#</th>
                                        <th scope="col">Modelo</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Stock</th>                             
                                        <th scope="col">Precio U.</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Sub Total</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="lista-compra" class="table-activ3 ">
                                    
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-default">
                                        <!-- <div class="card-header">
                                            <h3 class="card-title">
                                            <i class="fas fa-dollar-sign"></i>                                           
                                            </h3>
                                        </div> -->
                                        <div class="card-body">
                                            <div class="info-box mb-3 bg-warning p-0">
                                                <span class="info-box-icon"><i class="fas fa-tag" style="color:white;"></i></span>
                                                <div class="info-box-content" style="color:white;">
                                                    <span class="info-box-text text-left"><B>TOTAL SIN DESCUENTO</B></span>
                                                    <span class="info-box-number" id="subtotal"></span>
                                                </div>
                                            </div>
                                            <!-- <div class="info-box mb-3 bg-warning">
                                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-left ">IVA</span>
                                                    <span class="info-box-number"id="con_igv">2</span>
                                                </div>
                                            </div> -->
                                            <!-- <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-left ">SIN DESCUENTO</span>
                                                    <span class="info-box-number" id="total_sin_descuento">12</span>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-default">
                                        <!-- <div class="card-header">
                                            <h3 class="card-title">
                                            <i class="fas fa-bullhorn"></i>
                                            Calculo 2
                                            </h3>
                                        </div> -->
                                        <div class="card-body">
                                            <div class="info-box mb-3 bg-danger">
                                                <span class="info-box-icon"><i class="fas fa-tags"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-left "><b>DESCUENTO</b></span>
                                                    <input id="descuento" type="number" min="1" placeholder="Ingrese descuento" class="form-control">
                                                </div>
                                            </div>
                                            <!-- <div class="info-box mb-3 bg-info">
                                                <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-left ">TOTAL</span>
                                                    <span class="info-box-number" id="total">12</span>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-default">                                       
                                        <div class="card-body">
                                        <!-- <div class="info-box mb-3 bg-success">
                                            <span class="info-box-icon"><i class="fas fa-money-bill-alt"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text text-left ">INGRESO</span>
                                                <input type="number" id="pago" min="1" placeholder="Ingresa Dinero" class="form-control">
                                               
                                            </div>
                                        </div> -->
                                        <div class="info-box mb-3 bg-info">
                                            <span class="info-box-icon"><i class="far fa-money-bill-alt"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text text-left "><B>TOTAL</B></span>
                                                <span class="info-box-number" id="total_compra"></span>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-md-4 mb-2">
                                <a href="../vista/catalogoLista.php" class="btn btn-primary btn-block">Volver al Catalogo</a>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <a href="#" class="btn btn-success btn-block" id="procesar-compra">Realizar Venta</a>
                            </div>
                        </div>
                    </div>
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

<script type="text/javascript" src="../js/datatables.min.js"></script>
<script type="text/javascript" src="../js/cliente.js"></script>
<script type="text/javascript" src="../js/carrito.js"></script>


