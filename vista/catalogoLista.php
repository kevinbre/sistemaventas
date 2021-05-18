<?php
session_start();
if($_SESSION['usuarioTipo']==1){
include_once 'layouts/header.php';
?>
<!-- Codigo -->
<style>
        .tabla-thead {            
            background: linear-gradient(to left, #484CCD, #3192FF);
            color:white;
            }
    </style> 

  <title>NAYIK | Catalogo</title>

<?php include_once 'layouts/nav.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header bg-dark">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogo</h1>
          </div>        
        </div>
      </div><!-- /.container-fluid -->
    
    </section>

    <!-- Contendeor -->
    <section class="content" style="margin-top:100px;">
    <div class="container">
       <div class="row">
           <div class="col-lg-12">  
          
            <div id="" class="dataTables_filter">
            <div class="agregar-producto-modal" >
            <div class="dataTables_filter-append"></div>
            <div class=""> 
            <button class="btn btn-default btn-sm float-right"><i class="fas fa-search"></i></button>
            <input id="buscar_producto" type="text "class="buscar_producto float-right" placeholder="Buscar">
            <div class="dataTables_filter-append"></div>
            
            </div>
           </div>
           <table id="tabla-catalogo"  data-order='[[ 5, "asc" ]]' data-page-length='25' class="table table-sm table-striped table-hover bg-dark" style="width:100%"> 
           
           
            <thead class="text-center bg-primary">
            
            <th class="emailocultar">SKU</th>
            <th>Modelo</th>
            <th>Categoria</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Vender</th>           
                    </thead>          
     
            <tbody id="lista-catalogo" class="text-center">                
      
            </tbody>
            <tfoot> </tfoot>

            
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
<script type="text/javascript" src="../js/catalogo.js"></script>
<script type="text/javascript" src="../js/carrito.js"></script>

