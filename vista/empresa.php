<?php
include "../modelo/conexion.php";
class empresa{
    var $datosEmpresa;
public function __construct(){
    $db = new conexion();
    $this->acceso = $db->pdo;

$alert = '';
$txtNombre = $_POST['txtNombre'];
$txtRSocial = $_POST['txtRSocial'];
$txtTelefono = $_POST['txtTelEmpresa'];
$txtDireccion = $_POST['txtDirEmpresa'];
$txtemail = $_POST['txtEmailEmpresa'];

$actualizar_empresa = mysqli_query($datosEmpresa, "UPDATE configuracion SET nombre = '$txtNombre', razon_social = '$txtRSocial', telefono = '$txtTelefono', email = '$txtemail', direccion = '$txtDireccion'");
mysqli_close($datosEmpresa);
if ($actualizar_empresa == true) {
  $alert = '<p class="msg_save">Configuración de empresa Actualizado</p>';
  header("location: ../configuracion.php");

} else {
  $alert = '<p class="msg_error">Error al Actualizar la Configuración de empresa</p>';
}
}
}
?>

 <?php
  include "layouts/footer.php";

  ?>