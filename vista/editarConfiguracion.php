<?php
session_start();
if($_SESSION['usuarioTipo']==1){
include_once 'layouts/header.php';
?>


<!-- Codigo -->
<title>NAYIK | Configuración</title>

<?php include_once 'layouts/nav.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Configuración</h1>
          </div>
          
         
        </div>
      </div>      

</section> 
    <!-- Page Heading -->  
    <section class="content">   
    <div class="row">
        <div class="col-lg-6 col-6">
        <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">                   
                    <img src="../img/avatarcirculo.png" class="profile-user-img img-fluid img-circle">
                </div>                   
                    <input id="id_usuario" type="hidden" value="<?php echo $_SESSION['usuario']?>">
                    <h3 id="nombreyape" class="profile-username text-center"></h3>
                    <p id="rol" class="text-muted text-center"></p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Correo</b> <a id="correo_usuario" class="float-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Nombre de Usuario</b> <a id="nombre_de_usuario" class="float-right"></a>
                        </li> 
                       
                                                                     
                    </ul>
                    </div>
                    </div>
                    </div>
                    
                    <div class="col-lg-6 col-6">
            <div class="card">             
                    <ul class="list-group">
                        <li class="list-group-item active bg-primary">Cambiar Contraseña</li>
                        
                        <form action="" method=" post" name="frmChangePass" id="frmChangePass" class="p-3">
                        
                            <div class="form-group">
                                <label>Contraseña Actual</label>
                                <input type="password" name="actual" id="actual" placeholder="Clave Actual" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nueva Contraseña</label>
                                <input type="password" name="nueva" id="nueva" placeholder="Nueva Clave" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Confirmar Contraseña</label>
                                <input type="password" name="confirmar" id="confirmar" placeholder="Confirmar clave" required class="form-control">
                            </div>
                           
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                            </div>
                        </form>
                    </ul>
             
            </div>
                    </div>
               

         

</section>   
    </div>

       
   
  <!-- /.content-wrapper -->
 
<?php include_once "layouts/footer.php"; ?>


<!-- Fin Codigo -->
<?php
}
else{
    header('Location: ../login.php');
}
?>
<script src="../js/usuario.js"></script>
        