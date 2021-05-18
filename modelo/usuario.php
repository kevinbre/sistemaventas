<?php
include_once 'conexion.php';
class usuario{
    var $objetos;
    public function __construct(){
        $db = new conexion();
        $this->acceso = $db->pdo;
    }
    function Loguearse($ingreso,$pass){
        $sql = "SELECT * FROM usuarios INNER JOIN roles ON rol_usuario = idRol WHERE BINARY nombre_usuario=:ingreso AND BINARY pass_usuario=:pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':ingreso' => $ingreso,':pass'=>$pass));
        $this->objetos = $query->fetchall();
        

        if($this->objetos == true) {           
            return $this->objetos;                
                echo 'coincide';
            }else {
                echo 
                '<script type="text/javascript">
                
                alert("El usuario no existe");
                window.location.assign("../login.php");
                </script>';            
                }        
       
    }
    function obtener_datos($id){
        $sql = "SELECT * FROM usuarios JOIN roles ON rol_usuario=idRol AND id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
       
    }
    function cambiar_contra($id_usuario,$actual,$nueva,$confirmar){
        $sql = "SELECT * FROM usuarios WHERE id_usuario=:id AND pass_usuario=:actual";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id_usuario, ':actual' => $actual));
        $this->objetos = $query->fetchall();
        
        if(!empty($this->objetos)){       
            if ($nueva != $confirmar) {
                echo 'nocoinciden';

            }else {     
                $sql="UPDATE usuarios SET pass_usuario=:nueva WHERE id_usuario=:id";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_usuario,':nueva'=>$nueva));
                echo 'update';
            }
        }
        else{
            echo 'noupdate';
        }
        
       
    }

    
}
?>