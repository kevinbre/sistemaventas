<?php
session_start();
if($_SESSION['usuarioTipo']==1){
include_once 'layouts/header.php';
?>
<!-- Codigo -->


  <title>NAYIK | Listado de Materias Primas</title>

<?php include_once 'layouts/nav.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header bg-dark">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de Materias Primas</h1>
          </div>        
        </div>
      </div><!-- /.container-fluid -->
 
    </section>  
    <!-- Modal editar Materias Primas -->
<div class="modal fade" id="editar_materiaprima" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="card-title">Editar Materia Prima</h3>
            <button data-dismiss="modal" aria-label="close" class="close " ></button>
            <span aria-hidden="true" class="float-right bg-primary"></span>
          </div>
            <div class="card-body">
              <form id="form-editar">
            <div class="form-group">
              <label for="modelo">Materia Prima</label>
              <input id="edit_nombre"type="text" class="form-control" placeholder="Ingresar nombre (Requerido)" required>
            </div> 
            <div class="form-group">
              <label for="categoria">Medición</label>
              <input type="text" placeholder="Seleccionar Medición" name="edit_medicion" id="edit_medicion" class="form-control">
            </div>   
            <!-- <div class="form-group">
               <label for="proveedor">Proveedor</label>
               <select type="text" placeholder="Seleccionar Proveedor del producto" name="proveedor" id="proveedor_edit" class="form-control select2" style="width:100%;"></select>
             </div>           -->
            <div class="form-group">
              <label for="precio">Existencia</label>
              <input id="edit_existencia"type="text" class="form-control" step="any" placeholder="Ingresar Precio (Requerido)" required>
            </div>           
              <input type="hidden" id="id_edit_materiaprima">
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
   <!-- Fin Modal Editar Materias Primas -->
       <!-- Modal Agregar Materias Primas -->
<div class="modal fade" id="modal-crear-materiaprima" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="card-title">Agregar Materia Prima</h3>
            <button data-dismiss="modal" aria-label="close" class="close " ></button>
            <span aria-hidden="true" class="float-right bg-primary"></span>
          </div>
            <div class="card-body">
            <form id="form-crear-materiaprima" action="" method="post" autocomplete="off">             
             <div class="form-group">
               <label for="nombre_materiaprima">Nombre</label>
               <input type="text" placeholder="Ingrese nombre de la Materia Prima (Requerido)" name="nombre_materiaprima" id="nombre_materiaprima" class="form-control" required>
             </div>
             <div class="form-group">               
               </select>
             </div>
             <div class="form-group">
               <label for="proveedor">Proveedor</label>
               <select type="text" placeholder="Seleccionar Proveedor del producto" name="proveedor_add" id="proveedor_add" class="form-control" style="width:100%;"></select>
             </div>  
             <div class="form-group">
               <label for="medicion_materiaprima">Medición</label>
               <input type="text" placeholder="Ingrese Medición de la Materia Prima (Requerido)" name="medicion_materiaprima" id="medicion_materiaprima" class="form-control" required>
             </div>
             <div class="form-group">
               <label for="existencia_materiaprima">Existencia</label>
               <input type="text" placeholder="Ingresar Existencia de la Materia Prima" name="existencia_materiaprima" id="existencia_materiaprima" class="form-control">
             </div>                
          <button type="submit" id="cargarmateriaprima" class="btn bg-gradient-primary float-right m-1">Guardar</button>
          <button type="button" id="cancelar" data-dismiss="modal" class="btn btn-danger float-right m-1">Cancelar</button>
          
            </form>
          </div>
        </div>
      </div>
    </div>
</div>   
   <!-- Fin Modal Agregar Materias Primas -->

    <!-- Contendeor -->
    <section class="content" style="margin-top:100px;">
    <div class="container">
       <div class="row">
           <div class="col-lg-12">  
           
            <div id="" class="dataTables_filter">
            <div class="agregar-materiaprima-modal" >            
            <button class="btn btn-dark float-left btn-sm" data-toggle="modal" data-target="#modal-crear-materiaprima"><i class="fas fa-layer-group"> </i> Agregar Materia Prima</button>            
            <div class="dataTables_filter-append"></div>
            <div class="">            
            <button class="btn btn-default btn-sm float-right"><i class="fas fa-search"></i></button>
            <input id="buscar_materiaprima" type="text "class="buscar_materiaprima float-right" placeholder="Buscar">
            <div class="dataTables_filter-append"></div>
            
            </div>
           </div>
           <table id="tabla-materiaprima"  data-order='[[ 5, "asc" ]]' data-page-length='25' class="display table table-sm bg-dark table-striped table-hover "> 
           
            <thead class="text-center bg-primary">           
            <tr>
                <th>Nombre</th>
                <th>Medición</th>
                <th>Proveedor</th>
                <th>Existencia</th>
                <th>Acciones</th>                         
            </tr>
        </thead>
            <tbody id="lista_materiaprima" class="text-center">


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
<script type="text/javascript" src="../js/carritomp.js"></script>
<script type="text/javascript" src="../js/materiaprima.js"></script>
<script type="text/javascript" src="../js/select2.min.js"></script>




