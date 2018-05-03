<?php

/** 
* Controlador de vistas
* @autor Miquel Costa
*/
 require_once("modelos/view_model.php");

class controlador_vistas {    

    /**
     * Permite acceder a la web INDICE mostrando los temas principales con sus categorias
     */
    public function indice()
    {
    	$obtener_temas = new modelo_vistas();
    	$temas = $obtener_temas -> listar_temas();
    	$subtemas = $obtener_temas -> listar_subtemas();
        if($temas && $subtemas){require_once 'vistas/indice.php';}
        else{header("Location: vistas/indice.php&error1");};
    }
    
    /**
     * Muestra el indice pero solo el tema principal seleccionado por el usuario.
     */
    public function indica()
    {
    	$id = $_GET['id'];
    	$obtener_tema = new modelo_vistas();
    	$obtener_tema -> setId($id);
    	$tema = $obtener_tema -> listar_tema();
    	$subtemas = $obtener_tema -> listar_subtemas();
    	if($tema && $subtemas){require_once 'vistas/indica.php';}
    	else{header("Location: vistas/indica.php&error1");};
    }
    
    
    public function pantalla_login()
    {
    	require_once ("vistas/login.php");
    }
    
    
    public function registrar()
    {
    	require_once ("vistas/registrar.php");
    }

    
}