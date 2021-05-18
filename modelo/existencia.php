<?php 
include_once 'conexion.php';
class Existencia{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }
    // function crear_existencia($id_compra,$id, $cantidad, $precio_compra){
    //     $sql="INSERT INTO compra_mp (compra_id, materiaprima_id, cantidad_mp, precio_mp) VALUES (:compra, :materiaprima, :cantidad, :precio)";
    //     $query = $this->acceso->prepare($sql);
    //     $query->execute(array(':compra'=>$id_compra,':materiaprima'=>$id, ':cantidad'=>$cantidad, ':precio'=>$precio_compra));
    //     echo 'add';
    //     if ($cantidad != 0){
    //         $sql="UPDATE materiasprimas SET existencia_materiaprima = existencia_materiaprima + $cantidad WHERE id_materiaprima = :id'";
    //         $query = $this->acceso->prepare($sql);
    //         $query->execute(array(':id'=>$id));
    //         echo 'add';
    //     }
    // }    
    function crear_existencia($id_compra,$id, $cantidad, $precio_compra){
        $sql="INSERT INTO compra_mp (compra_id, materiaprima_id, cantidad_mp, precio_mp) VALUES (:compra, :materiaprima, :cantidad, :precio)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':compra'=>$id_compra,':materiaprima'=>$id, ':cantidad'=>$cantidad, ':precio'=>$precio_compra));
        echo 'add';

        if (!empty($query)){
            $sql="UPDATE materiasprimas SET existencia_materiaprima = existencia_materiaprima+:cantidad WHERE id_materiaprima=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':cantidad'=>$cantidad,':id'=>$id));
            echo true;
        }
        
    }  
    function ver($id_compra){ 
        $sql="SELECT id_compra, fecha_compra, total_compra, 
        usuarios.usuario_nomyape, 
        proveedores.nombre_proveedor, proveedores.telefono_proveedor,proveedores.direccion_proveedor,materiasprimas.nombre_materiaprima, materiasprimas.medicion_materiaprima,
        compra_mp.cantidad_mp, compra_mp.precio_mp
        FROM compras 
        JOIN usuarios on id_usuario = vendedor_id 
        JOIN proveedores on id_proveedor = proveedor_id
        JOIN compra_mp on compra_id = :id
        JOIN materiasprimas on id_materiaprima = materiaprima_id
        WHERE id_compra = :id_compra";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_compra'=>$id_compra));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    
   
    function devolver($materiaprima_id, $cantidad_mp){
        $sql="SELECT * FROM materiasprimas WHERE id_materiaprima = :materiaprima_id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':materiaprima_id'=>$materiaprima_id));
        $stock=$query->fetchAll(); 
        echo 'devuelto';
              
        if (!empty($stock)){
            $sql="UPDATE materiasprimas SET existencia_materiaprima = existencia_materiaprima - :cantidad_mp WHERE id_materiaprima= :materiaprima_id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':cantidad_mp'=>$cantidad_mp,':materiaprima_id'=>$materiaprima_id));
            echo true;
        }
        
    }
}

