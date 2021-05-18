<?php 
include '../modelo/stock.php';
$stock = new Stock();
if($_POST['funcion']=='crear_stock'){

$prod_id = $_POST['prod_id'];
$prod_stock = $_POST['prod_stock'];

$stock->crear($prod_id, $prod_stock);

}


?>