<?php
session_start();
if($_SESSION['usuarioTipo']==1){
include_once 'layouts/header.php';
?>
<!-- Codigo -->


  <title>NAYIK | Listado de Productos</title>

<?php include_once 'layouts/nav.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header bg-dark">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de Productos</h1>
          </div>        
        </div>
      </div><!-- /.container-fluid -->
 
    </section>
   <!-- Modal editar Stock -->
<div class="modal fade" id="editar_producto_stock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="card-title">Editar Stock</h3>
            <button data-dismiss="modal" aria-label="close" class="close " ></button>
            <span aria-hidden="true" class="float-right bg-primary"></span>
          </div>
            <div class="card-body">
              <form id="form-editar-stock">
                   
            <div class="form-group">
              <label for="sku_stock">SKU#</label>
              <input id="sku_stock" type="text" class="form-control"  disabled>
            </div>
            <div class="form-group">
              <label for="modelo_stock">Modelo</label>
              <input id="modelo_stock"type="text" class="form-control"disabled>
            </div>   
            <div class="form-group">
              <label for="categoria_stock">Categoria</label>
              <input id="categoria_stock" type="text" class="form-control" disabled>
            </div>   
            <div class="form-group">
              <label for="stock">Stock</label>
              <input id="editar_stock"type="text" class="form-control" placeholder="Ingresar Stock (Requerido)" required>
            </div>              
              <input type="hidden" id="id_edit_stock">
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
   <!-- Fin Modal Editar Stock --> 
    <!-- Modal editar Productos -->
<div class="modal fade" id="editar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="card-title">Editar Producto</h3>
            <button data-dismiss="modal" aria-label="close" class="close " ></button>
            <span aria-hidden="true" class="float-right bg-primary"></span>
          </div>
            <div class="card-body">
              <form id="form-editar">
            <div class="form-group">
              <label for="modelo">Modelo</label>
              <input id="edit_modelo"type="text" class="form-control" placeholder="Ingresar nombre (Requerido)" required>
            </div> 
            <div class="form-group">
              <label for="categoria">Categoria</label>
              <select type="text" placeholder="Seleccionar categoria del producto" name="edit_tipo_producto" id="edit_tipo_producto" class="form-control select2 edit_tipo_producto" style="width:100%;" ></select>
            </div>             
            <div class="form-group">
              <label for="precio">Precio</label>
              <input id="edit_precio"type="text" class="form-control" step="any" placeholder="Ingresar Precio (Requerido)" required>
            </div>           
              <input type="hidden" id="id_edit_producto">
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
   <!-- Fin Modal Editar Productos -->
       <!-- Modal Agregar Productos -->
<div class="modal fade" id="modal-crear-producto" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="card-title">Agregar Producto</h3>
            <button data-dismiss="modal" aria-label="close" class="close " ></button>
            <span aria-hidden="true" class="float-right bg-primary"></span>
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
               <label for="tipo_producto">Categoria</label>
               <select type="text" placeholder="Seleccionar categoria del producto" name="tipo_producto" id="tipo_producto" class="form-control select2" style="width:100%;"></select>
             </div>
             <div class="form-group">
               <label for="precio_producto">Precio</label>
               <input type="text" placeholder="Ingrese precio" class="form-control" name="precio_producto" id="precio_producto">
             </div>         
          <button type="submit" id="cargarprod" class="btn bg-gradient-primary float-right m-1">Guardar</button>
          <button type="button" id="cancelar" data-dismiss="modal" class="btn btn-danger float-right m-1">Cancelar</button>
          
            </form>
          </div>
        </div>
      </div>
    </div>
</div>   
   <!-- Fin Modal Agregar Productos -->

    <!-- Contendeor -->
    <section class="content" style="margin-top:100px;">
    <div class="container">
       <div class="row">
           <div class="col-lg-12">  
           
            <div id="" class="dataTables_filter">
            <div class="agregar-producto-modal" >            
            <button class="btn btn-dark float-left btn-sm" data-toggle="modal" data-target="#modal-crear-producto"><i class="fas fa-layer-group"> </i> Agregar Producto</button>            
            <div class="dataTables_filter-append"></div>
            <div class="">            
            <button class="btn btn-default btn-sm float-right"><i class="fas fa-search"></i></button>
            <input id="buscar_producto" type="text "class="buscar_producto float-right" placeholder="Buscar">
            <div class="dataTables_filter-append"></div>
            
            </div>
           </div>
           <table id="tabla-productos"  data-order='[[ 5, "asc" ]]' data-page-length='25' class="display table table-sm bg-dark table-striped table-hover "> 
           
            <thead class="text-center bg-primary">           
            <tr>
                <th class="emailocultar">SKU#</th>
                <th>Modelo</th>
                <th class="emailocultar">Categoria</th>
                <th>Stock</th>
                <th>Precio U.</th>
                <th>Acciones</th>
            </tr>
        </thead>
            <tbody id="lista_productos" class="text-center">


            </tbody>
          
        <tfoot>
        
        </tfoot>
    </table>

            
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
<script type="text/javascript" src="../js/datatables.min.js"></script>
<script type="text/javascript" src="../js/producto.js"></script>
<script type="text/javascript" src="../js/select2.min.js"></script>




