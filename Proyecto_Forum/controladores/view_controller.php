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
    	$usuarios = $obtener_temas -> get_user();
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
    	$usuarios = $obtener_tema -> get_user();
    	if($tema && $temas && $subtemas && $contapost && $MSGT){require_once 'vistas/indica.php';}
    	else{header("Location: vistas/indica.php&error1");}
    }
    
    /**
     * Muestra la pantalla de login
     */
    public function pantalla_login()
    {
    	$obtener_categorias = new modelo_vistas();
    	$temas = $obtener_categorias-> listar_temas();
    	require_once ("vistas/login.php");
    }
    
    /**
     * Muestra la pantalla para crear un nuevo post
     */
    public function mostrar_crear_tema()
    {
    	$obtener_categorias = new modelo_vistas();
    	$temas = $obtener_categorias -> listar_temas();
    	require_once ("vistas/nuevoTema.php");
    }
    
    
    /**
     * Muestra el editor de post
     */
    public function mostrar_editar_tema()
    {
    	$idp = $_GET['idp'];
    	
    	$obtener_categorias = new modelo_vistas();
    	$temas = $obtener_categorias -> listar_temas();
    	$obtener_categorias -> setIdp($idp);
    	$post = $obtener_categorias-> mostrar_post();
    	require_once ("vistas/editarP.php");
    }
    
    
    /**
     * Muestra un mensaje que indica que la cuenta de usuario ha sido activada.
     */
    public function mostrar_activado()
    {
    	$obtener_categorias = new modelo_vistas();
    	$temas = $obtener_categorias-> listar_temas();
    	require_once ("vistas/activado.php");
    }
    
    /**
     * Muestra una pantalla que permite al usuario escribir su email para solicitar un email de activación de cuenta en caso de que pierda el email al registrarse.
     */
    public function mostrar_reactivado()
    {
    	$obtener_categorias = new modelo_vistas();
    	$temas = $obtener_categorias-> listar_temas();
    	require_once ("vistas/reactivar.php");
    }
    
    
    /**
     * Muestra la pantalla de registro
     */
    public function registrar()
    {
    	$obtener_categorias= new modelo_vistas();
    	$temas = $obtener_categorias-> listar_temas();
    	require_once ("vistas/registrar.php");
    }

    /**
     * Muestra el listado de subindice
     */
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
    
    /**
     * Muestra un post y sus mensajes
     */
    public function mostrar_tema()
    {
    	$idp = $_GET['idp'];
    	$idt = $_GET['idt'];
    	$idst = $_GET['idst'];
    	$obtener_post = new modelo_vistas();
    	$obtener_usuario = new modelo_usuario();
    	$obtener_post -> setIdp($idp);
    	$obtener_post -> setId($idt);
    	$obtener_post -> setIdst($idst);
    	$temas = $obtener_post -> listar_temas();
    	$tema = $obtener_post -> listar_tema();
    	$subtema = $obtener_post -> listar_subtema();
    	$post = $obtener_post -> mostrar_post();
    	$mensajes = $obtener_post -> mostrar_mensajes();
    	$MSG = $obtener_post -> contador_mensajes_totales();
    	$usuarios = $obtener_post -> get_user();
    	$preferencias = $obtener_post -> mostrar_preferencias();
    	if(isset($_SESSION['user'])){
	    	$obtener_usuario -> setNombre($_SESSION['user']);
	    	$nivel = $obtener_usuario -> verificar_nivel();
    	} else {$nivel = array('nivel' => '0');}
    	if($post && $mensajes){require_once 'vistas/tema.php';}
    	else{header("Location: vistas/tema.php&error1");}
    }
        
    
    /** 
     * Muestra la pantalla para responder
     */
    public function mostrar_responder()
    {
    	$idp = $_GET['idp'];
    	$obtener_respuesta= new modelo_vistas();
    	$temas = $obtener_respuesta-> listar_temas();
    	$obtener_respuesta -> setIdp($idp);
    	$post = $obtener_respuesta-> mostrar_post();
    	require_once ("vistas/responder.php");
    }
    
    /**
     * Muestra la pantalla para editar una respuesta
     */
    public function mostrar_editarR()
    {
    	$idp = $_GET['idp'];
    	$mid = $_GET['mid'];
    	$obtener_respuesta= new modelo_vistas();
    	$temas = $obtener_respuesta-> listar_temas();
    	$obtener_respuesta -> setId($mid);
    	$obtener_respuesta -> setIdp($idp);
    	$mensaje = $obtener_respuesta-> mostrar_editarR();
    	$post = $obtener_respuesta-> mostrar_post();
    	require_once ("vistas/editarR.php");
    }
    
    
    /**
     * Muestra la pantalla de perfil de usuario
     */
    public function mostrar_perfil()
    {
    	$obtener_temas = new modelo_vistas();
    	$obtener_usuario = new modelo_usuario();
    	$temas = $obtener_temas -> listar_temas();
    	$obtener_usuario -> setId($_SESSION['uid']);
    	$usuario = $obtener_temas -> get_user();
    	$preferencias = $obtener_usuario -> get_preferencias();
    	$MSG = $obtener_temas -> contador_mensajes_totales();
    	if($temas && $preferencias && $MSG){require_once 'vistas/perfil.php';}
    	else{header("Location: vistas/perfil.php&error1");}
    }    
}