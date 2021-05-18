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
            <h1>Inicio</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
          
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">     


 <!-- Small boxes (Stat box) -->
 <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="clientes-box">0</h3>

                <p>Clientes registrados</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-friends"></i>
              </div>
              <a href="../vista/listaClientes.php" class="small-box-footer">Ir a Clientes <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="productos-box">0</h3>

                <p>Productos en Catalogo</p>
              </div>
              <div class="icon">
                <i class="fas fa-box-open"></i>
              </div>
              <a href="../vista/catalogoLista.php" class="small-box-footer">Ir a Catalogo <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning"style="color:white;" >
              <div class="inner" style="color:white;">
                <h3 id="ventas-box">0</h3>

                <p>Ventas realizadas</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              
              <a href="../vista/vistaVentas.php" class="small-box-footer" ><i style="color:white;font-style:normal;">Ir a Ventas </i><i class="fas fa-arrow-circle-right" style="color:white;"></i></a>
                </div>
          
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="compras-box">0</h3>

                <p>Compras efectuadas</p>
              </div>
              <div class="icon">
                <i class="fas fa-folder-open"></i>
              </div>
              <a href="../vista/vistaCompras.php" class="small-box-footer">Ir a Compras <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->    
</section>
   <!-- Custom tabs (Charts with tabs)-->
   <section class="content">   
   <div class="row"> 
   <section class="content col-lg-9 col-12 connectedSortable">  
  
   <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Ventas
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">                   
                    </li>                    
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="grafico"
                       style="position: relative; height: 300px;">
                      <canvas class="chart" id="Grafico1" height="300" style="height: 300px;"></canvas>
                   </div>
                 
                </div>
              </div><!-- /.card-body -->
            </div>
          
</section>
            <!-- /.card -->
               <!-- Calendar -->
               <section class="content col-lg-3 col-12 connectedSortable">  
             
               <div class="card bg-primary">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <!-- <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div> -->
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
</section>      
</div>
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

<script src="../js/moment.min.js"></script>
<script src="../js/Chart.js"></script>
<script src="../js/ventas.js"></script>
<script src="../js/grafico.js"></script>
<script src="../js/tempusdominus-bootstrap-4.min.js"></script>

<script>  // The Calender
    $('#calendar').datetimepicker({
      language: 'es',
        format: 'L',
        inline: true,      
    })
</script>