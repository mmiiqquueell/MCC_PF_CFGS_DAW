<?php

/** 
* Controlador de vistas
* @autor Miquel Costa
*/
// require_once("modelos/modelo_usuario.php");

class controlador_vistas {    

    /**
     * Permite acceder a la web mientras está sin protección. Será eliminado posteriormente cuando login sea seguro.
     */
    public function seguridad_temporal()
    {
        require_once ("vistas/iniciar.php");
    }
    
    public function registrar()
    {
    	require_once ("vistas/registrar.php");
    }
    
    
    public function indice()
    {
        $usuario = $_POST['nombre'];
        $password = $_POST['password'];
        if ($usuario == 'Administrador' && $password == 'Ageofempires2') {
            header ("Location: vistas/indice.php");
        } else {
            echo "¡ACCESS DENIED!";
        }
    }
    
    
    /**
    * Muestra página portada // Añade función para mostrar cesta
    */
    public function home(){
        $productos = new modelo_producto();
        $productosC = new modelo_producto();
        $pro = $productos -> get_producto();
        $proC = $productosC -> get_producto_slider();
        $user = new modelo_usuario(); 
        $uNivel = $user -> get_nivel();
        if(isset($_SESSION['nombre'])){
            $cesta = new modelo_cesta();
            $cesta -> setNombre($_SESSION['nombre']);
            $ucesta = $cesta -> get_id_cesta();
            $cesta -> setIdCesta($ucesta['ID']);
            $lista3 = $cesta -> lista_cesta();
            $CanPro = $cesta -> get_cantidad_productos();
        }
        else{
            if(isset($_SESSION['invitado']) && !isset($_SESSION['invitadoD'])){
                $CanPro['CARRITO'] = count($_SESSION['invitado']);
            }
            elseif(isset($_SESSION['invitadoD']) && !isset($_SESSION['invitado'])){
                $CanPro['CARRITO'] = count($_SESSION['invitadoD']);
            }
            elseif(isset($_SESSION['invitado']) && isset($_SESSION['invitadoD'])){
                $CanPro['CARRITO'] = (count($_SESSION['invitadoD']) + count($_SESSION['invitado']));
            }
            else {$CanPro['CARRITO'] = "0";}
        }
        require_once ("vistas/portada.php");
    }
        
}