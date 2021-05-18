<?php 

include_once 'conexion.php';
class Compras{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($fecha_compra,$proveedor,$usuario,$total){
        $sql ="INSERT INTO compras(fecha_compra,total_compra,vendedor_id,proveedor_id) VALUES (:fecha,:total,:usuario,:proveedor) ";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha_compra, ':total'=>$total,':usuario'=>$usuario,':proveedor'=>$proveedor));          
    }
    function ultima_compra(){
        $sql="SELECT MAX(id_compra) as ultima_compra FROM compras";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function listar_compras(){
        $sql="SELECT id_compra, fecha_compra, total_compra, 
        usuarios.usuario_nomyape, 
        proveedores.nombre_proveedor, proveedores.telefono_proveedor,proveedores.direccion_proveedor       
        FROM compras 
        JOIN usuarios on id_usuario = vendedor_id 
        JOIN proveedores on id_proveedor = proveedor_id";
        
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function ver($id){ 
        $sql="SELECT id_compra, fecha_compra, total_compra, 
        usuarios.usuario_nomyape, 
        proveedores.nombre_proveedor, proveedores.telefono_proveedor,proveedores.direccion_proveedor       
        FROM compras 
        JOIN usuarios on id_usuario = vendedor_id 
        JOIN proveedores on id_proveedor = proveedor_id
        JOIN compra_mp on compra_id = :id        
        WHERE id_compra = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }   
    function obtenerDatos($id){
        $sql="SELECT id_compra, fecha_compra, total_compra, 
        usuarios.usuario_nomyape, 
        proveedores.nombre_proveedor, proveedores.telefono_proveedor,proveedores.direccion_proveedor,materiasprimas.nombre_materiaprima, materiasprimas.medicion_materiaprima,
        compra_mp.cantidad_mp, compra_mp.precio_mp
        FROM compras 
        JOIN usuarios on id_usuario = vendedor_id 
        JOIN proveedores on id_proveedor = proveedor_id
        JOIN compra_mp on compra_id = :id
        JOIN materiasprimas on id_materiaprima = materiaprima_id
        WHERE id_compra = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function recuperar($id_compra){
        $sql="SELECT * FROM compra_mp WHERE compra_id = :id_compra";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_compra'=>$id_compra));
        $this->objetos=$query->fetchall();
        return $this->objetos;

    }
    function borrar_mp($id_compra){
        $sql="DELETE FROM compra_mp where compra_id=:id_compra";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_compra'=>$id_compra));
        if(!empty($query->execute(array(':id_compra'=>$id_compra)))){
            echo 'borrado';
        }else{
            echo 'noborrado';
        }
        }
        function borrar($id_compra){
            $sql="DELETE FROM compras where id_compra=:id_compra";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id_compra'=>$id_compra));
            if(!empty($query->execute(array(':id_compra'=>$id_compra)))){
                echo 'borrado';
            }else{
                echo 'noborrado';
            }
            }
    
}      
    


?>