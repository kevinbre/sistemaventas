<?php
include '../modelo/usuario.php';
session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];
$usuario = new Usuario();




$usuario->Loguearse($user,$pass);
if(!empty($usuario->objetos)) {    
    foreach ($usuario->objetos as $objeto) {
        $_SESSION['usuario']=$objeto->id_usuario;
        $_SESSION['usuarioTipo']=$objeto->rol_usuario;
        $_SESSION['usuarioNombre']=$objeto->nombre_usuario;
        $_SESSION['usuario_nomyape']=$objeto->usuario_nomyape;  


    } 

    switch ($_SESSION['usuarioTipo']) {
        case 1:
            header('Location: ../vista/index.php');
            break;
        case 2:
            header('Location: ../vista/index.php');
            break;    
    }
}













    






?>