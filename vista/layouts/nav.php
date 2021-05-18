   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Select2 -->
  <link rel="stylesheet" href="../css/select2.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/css/all.min.css">
  <!-- Compras Estilo -->
  <link rel="stylesheet" href="../css/compras.css">
  <!-- Chart Estilo -->
  <link rel="stylesheet" href="../css/Chart.css">
  <!-- Tempusdominus-->
  <link rel="stylesheet" href="../css/tempusdominus-bootstrap-4.min.css"> 
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/adminlte.min.css"> 
  <!-- Carrito CSS -->
  <link rel="stylesheet" href="../css/main.css">
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="../css/bootstrap-4.min.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="../css/sweetalert2.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../css/toastr.min.css">
  <!-- datatables -->
  <link rel="stylesheet" type="text/css" href="../css/datatables.min.css"/>
   <!-- datatables -->
   <link rel="stylesheet" type="text/css" href="../css/datatables.min.css"/>
  
</head>
<body class="hold-transition sidebar-mini dark-mode">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar Home y Contacto -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>

      </li>             
      
     <!-- Carrito de Ventas -->              
  <li class="nav-item dropdown bg-dark" id="cat-carrito" style="display:none">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="icono-carrito fas fa-shopping-cart btn-xm "><span id="contador" class="contador badge badge-danger"></span></i>  
      </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">         
        
          <table class="carro table text-noweap p-2"> 
            <thead class="card-header bg-primary hover">
              
              <p class="titulo-carro card-header bg-primary hover text-center">Carro de Ventas</p>
        <tr>              
       <th>SKU#</th>
       <th>Modelo</th>
       <th>Categoria</th>      
       <th>Precio</th>
       <th>Eliminar</th>
     </tr>
             </thead>
            </thead>
  
   <tbody id="lista-carrito" class="text-center">
     <ul>
  </ul>
   </tbody>
   </table> 
   <div class="text-center">
  <a href="#" id="procesar-pedido" class="btn btn-success btn-sm">Procesar venta</a>
  <a href="#" id="vaciar-carrito" class="btn btn-danger btn-sm">Vaciar carrito</a>
  </div>
     </li>
    

  <!-- Fin Carrito Ventas -->
   <!-- Carrito de Compras -->              
   <li class="nav-item dropdown bg-dark" id="cat-carrito-wwmp" style="display:none">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="icono-carrito-mp fas fa-shopping-cart btn-xm "><span id="contadormp" class="contadormp badge badge-danger"></span></i>  
      </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">         
        
          <table class="carro table text-noweap p-2"> 
            <thead class="card-header bg-primary hover">
              
              <p class="titulo-carro card-header bg-primary hover text-center">Carro de Compras</p>
        <tr>              
       <th>SKU#</th>
       <th>Modelo</th>
       <th>Categoria</th>      
       <th>Precio</th>
       <th>Eliminar</th>
     </tr>
             </thead>
            </thead>
  
   <tbody id="lista-carrito-mp" class="text-center">
     <ul>
  </ul>
   </tbody>
   </table> 
   <div class="text-center">
  <a href="#" id="procesar-pedido-mp" class="btn btn-success btn-sm">Procesar Compra</a>
  <a href="#" id="vaciar-carrito-mp" class="btn btn-danger btn-sm">Vaciar carrito</a>
  </div>
     </li>
      </li> 
  </ul> 

  <!-- Fin Carrito -->


   
     
 

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
    <a href="../controlador/logout.php" class="nav-link">Cerrar Sesión<i class="fas fa-sign-out-alt" style="padding-left:10px;"></i></a>
 
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../vista/index.php" class="brand-link">
      <img src="../img/logoavatar.png" alt="nayikLogo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">NAYIK SISTEMA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../img/avatarcirculo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="../vista/editarConfiguracion.php" class="d-block"><?php  echo $_SESSION['usuario_nomyape'] ?></a>
        </div>
      </div>      
    

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="../vista/index.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Inicio
              </p>
            </a>
          </li>
      
          <!-- Clientes -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Clientes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../vista/listaClientes.php" class="nav-link">
                  <i class="fas fa-list-ul"></i>
                  <p>Lista de Clientes</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="../vista/nuevoCliente.php" class="nav-link">
                  <i class="fas fa-user-plus"></i>
                  <p>Nuevo Cliente</p>
                </a>
              </li>             -->
            </ul>
          </li>
        <!-- Productos -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-box-open"></i>
              <p>
                Productos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../vista/listaProductos.php" class="nav-link">
                  <i class="fas fa-list"></i>
                  <p>Productos</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="../vista/nuevoProducto.php" class="nav-link">
                  <i class="fas fa-money-check-alt"></i>
                  <p>Agregar Producto</p>
                </a>
              </li>             -->
            </ul>
          </li>
              <!-- Ventas -->
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Ventas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../vista/catalogoLista.php" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Nueva venta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../vista/vistaVentas.php" class="nav-link">
                  <i class="fas fa-clipboard-list"></i>
                  <p>Ventas realizadas</p>
                </a>
              </li>            
            </ul>
          </li>
          
        <!-- Proveedores -->
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Proveedores
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../vista/listaProveedores.php" class="nav-link">
                  <i class="fas fa-stream"></i>
                  <p>Listado</p>
                </a>
              </li>                       
            </ul>
          </li>

        <!-- Materias Primas -->
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-seedling"></i>
              <p>
                Materias Primas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="../vista/listaMateriasPrimas.php" class="nav-link">
                  <i class="fas fa-stream"></i>
                  <p>Lista de Materias Primas</p>
                </a>
              </li>  
              <li class="nav-item">
              <a href="../vista/compraMateriaPrima.php" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Nueva Compra</p>
                </a>
              </li> 
              <li class="nav-item">
              <a href="../vista/vistaCompras.php" class="nav-link">
                  <i class="fas fa-folder-open"></i>
                  <p>Compras Registradas</p>
                </a>
              </li>                       
            </ul>
          </li>
        
          
        
          <li class="nav-item">
            <a href="../vista/editarConfiguracion.php" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Configuración
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
