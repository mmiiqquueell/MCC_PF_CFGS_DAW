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
    	$contapost = $obtener_temas -> contador_post();
    	$MSGT = $obtener_temas -> contador_mensajes_totales();
    	if($temas && $subtemas && $contapost && $MSGT){require_once 'vistas/indice.php';}
        else{header("Location: vistas/indice.php&error1");}
    }
    
    /**
     * Muestra el indice pero solo el tema principal seleccionado por el usuario.
     */
    public function indica()
    {
    	$id = $_GET['id'];
    	$obtener_tema = new modelo_vistas();
    	$obtener_tema -> setId($id);
    	$temas = $obtener_tema -> listar_temas();
    	$tema = $obtener_tema -> listar_tema();
    	$subtemas = $obtener_tema -> listar_subtemas();
    	$contapost = $obtener_tema -> contador_post();
    	$MSGT = $obtener_tema -> contador_mensajes_totales();
    	if($tema && $temas && $subtemas && $contapost && $MSGT){require_once 'vistas/indica.php';}
    	else{header("Location: vistas/indica.php&error1");}
    }
    
    
    public function pantalla_login()
    {
    	$obtener_categorias = new modelo_vistas();
    	$temas = $obtener_categorias-> listar_temas();
    	require_once ("vistas/login.php");
    }
    
    
    public function registrar()
    {
    	$obtener_categorias= new modelo_vistas();
    	$temas = $obtener_categorias-> listar_temas();
    	require_once ("vistas/registrar.php");
    }

    public function mostrar_subindice() 
    {
    	$idst = $_GET['idst'];
    	$id = $_GET['idt'];
    	$obtener_subtema = new modelo_vistas();
    	$obtener_subtema -> setIdst($idst);
    	$obtener_subtema -> setId($id);
    	$temas = $obtener_subtema -> listar_temas();
    	$tema = $obtener_subtema -> listar_tema();
    	$subtema = $obtener_subtema -> listar_subtema();
    	$post = $obtener_subtema -> mostrar_posts();
    	$MSG = $obtener_subtema -> contador_mensajes_totales();
    	$usuarios = $obtener_subtema -> get_user();
    	if($post) {require_once 'vistas/subindice.php';}
    	else{header("Location: vistas/subindice.php&error1");}
    }
    
    public function mostrar_tema()
    {
    	$idp = $_GET['idp'];
    	$idt = $_GET['idt'];
    	$idst = $_GET['idst'];
    	$obtener_post = new modelo_vistas();
    	$obtener_post -> setIdp($idp);
    	$obtener_post -> setId($idt);
    	$obtener_post -> setIdst($idst);
    	$temas = $obtener_post -> listar_temas();
    	$tema = $obtener_post -> listar_tema();
    	$subtema = $obtener_post -> listar_subtema();
    	$post = $obtener_post -> mostrar_post();
    	$mensajes = $obtener_post -> mostrar_mensajes();
    	$usuarios = $obtener_post -> get_user();
    	$preferencias = $obtener_post -> mostrar_preferencias();
    	if($post && $mensajes){require_once 'vistas/tema.php';}
    	else{header("Location: vistas/tema.php&error1");}
    }
    
}