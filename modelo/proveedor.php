<?php 

include 'conexion.php';
class Proveedor{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$telefono,$direccion){
        $sql="SELECT nombre_proveedor FROM proveedores WHERE nombre_proveedor=:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){            
            echo false;            
        }
        else{
            $sql ="INSERT INTO proveedores(nombre_proveedor,telefono_proveedor,direccion_proveedor) VALUES (:nombre,:telefono,:direccion) ";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':telefono'=>$telefono,':direccion'=>$direccion));          
            echo true;
            
        }
    }
    function buscar_proveedor(){
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            
            $sql="SELECT * FROM proveedores WHERE nombre_proveedor LIKE :consulta ";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }else{
            $sql="SELECT * FROM proveedores WHERE nombre_proveedor  NOT LIKE '' ORDER BY nombre_proveedor";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
    
    }
        function borrar($id){
        $sql="DELETE FROM proveedores where id_proveedor=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }else{
            echo 'noborrado';
        }
        }

function editar($id, $nombre, $telefono, $direccion){
    $sql="SELECT id_proveedor FROM proveedores WHERE id_proveedor=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchall();
    if(empty($this->objetos)){
        echo false;
    }else{
        $sql="UPDATE proveedores SET nombre_proveedor=:nombre, telefono_proveedor=:telefono, direccion_proveedor=:direccion WHERE id_proveedor=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$nombre,':telefono'=>$telefono,':direccion'=>$direccion));
        echo true;
    }
}
function rellenar_proveedores(){
    $sql="SELECT * FROM proveedores";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this-> objetos;
}

function rellenar_productos() {
        $sql="SELECT id_mp_pv, id_prov, 
        proveedores.nombre_proveedor,
        proveedores.id_proveedor,   
        materiasprimas.id_materiaprima,
        materiasprimas.nombre_materiaprima,   
        materiasprimas.id_prov_mp
        FROM mp_por_prov 
        JOIN proveedores
        JOIN materiasprimas
        on id_prov = id_proveedor 
        AND id_mp_pv = id_materiaprima";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this-> objetos;
}


    function rellenar_usuario(){
        $sql="SELECT * FROM usuarios";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this-> objetos;

    }

    function  relleno_automatico($id){
    $sql="SELECT id_mp_pv, id_prov, 
    proveedores.nombre_proveedor,
    proveedores.id_proveedor,
    materiasprimas.id_materiaprima,
    materiasprimas.nombre_materiaprima,
    materiasprimas.medicion_materiaprima,
    materiasprimas.existencia_materiaprima
    FROM mp_por_prov 
    JOIN proveedores
    JOIN materiasprimas
    on id_prov = id_proveedor 
    AND id_mp_pv = id_materiaprima
    WHERE id_proveedor = :id";
     $query = $this->acceso->prepare($sql);
     $query->execute(array(':id'=>$id));
     $this->objetos=$query->fetchall();
     return $this->objetos;
    }
}

?>