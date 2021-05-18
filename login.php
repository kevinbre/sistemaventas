<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login NAYIK</title>
    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <!-- Estilos -->
    <link rel= "stylesheet" type="text/css" href="css/style.css"/>
    <link rel= "stylesheet" type="text/css" href="css/css/all.min.css"/>
    <!-- SweetAlert2 -->
   <link rel="stylesheet" href="css/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="css/toastr.min.css">
    <link rel="shortcut icon" href="img/favicon.png">
</head>
<?php
session_start();
if(!empty($_SESSION['rolUsuario'])){
    header('Location: controlador/LoginController.php');
}
else{
    session_destroy();
?>
    <body>
        <img class="wave" src="img/lateral.png" alt="">
        <div class="contenedor">
            <div class="img">
                <img src="img/inicio.png" alt="">            
            </div>
            <div class="contenido-login">
                <form action="controlador/loginController.php" method="post" id="formLogin">
                    <img src="img/logologin.png" alt="">
                    <h2></h2>
                    <div class="input-div usuarios">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input id="user" type="text" name="user" class="input">
                    </div>
                    </div>
                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Contraseña</h5>
                            <input id="pass" type="password" name="pass" class="input">
                        </div>
                    </div>
                    <input type="submit" class="btn" value="Iniciar Sesión">
                </form>
            </div>
        </div>
    </body>
    <!-- Toastr -->
    <script src="js/toastr.min.js"></script>
    <!-- SweetAlert2 -->   
    <script src="js/login.js"></script>
</html>
<?php
}
?>