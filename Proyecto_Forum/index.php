<?php
session_start();
require_once("base_de_datos/db.php");
require_once("controladores/view_controller.php");
require_once("controladores/user_controller.php");
require_once("controladores/post_controller.php");


if (isset($_GET['controller']) && isset($_GET['action'])) {
    
    /* CONTROLADOR DE VISTAS */
    if ($_GET['controller'] == "vistas") {
        
        $controller = new controlador_vistas();
        
        if($_GET['action'] == "indice") {$controller -> indice();} // Mostrar temas principales
        elseif($_GET['action'] == "indica") {$controller -> indica();} // Mostrar temas principales separados
        elseif($_GET['action'] == "subindice") {$controller -> mostrar_subindice();} // Mostrar SubTemas        
        elseif($_GET['action'] == "tema") {$controller -> mostrar_tema();} // Mostrar SubTemas
        elseif($_GET['action'] == "pantalla_login") {$controller -> pantalla_login();} // Mostrar pantalla de login
        elseif($_GET['action'] == "registrar") {$controller -> registrar();} // Mostrar pantalla de registro
        elseif($_GET['action'] == "perfil") {$controller -> mostrar_perfil();} // Mostrar pantalla de perfil
        elseif($_GET['action'] == "nuevoTema") {$controller -> mostrar_crear_tema();} // Mostrar pantalla de nuevo tema
        elseif($_GET['action'] == "editarTema") {$controller -> mostrar_editar_tema();} // Mostrar pantalla de editar temas
        elseif($_GET['action'] == "responder") {$controller -> mostrar_responder();} // Mostrar pantalla de responder tema
        elseif($_GET['action'] == "editar") {$controller -> mostrar_editarR();} // Mostrar pantalla de editar mensaje
        elseif($_GET['action'] == "master") {$controller -> mostrar_master();} // Mostrar pantalla de administración
        elseif($_GET['action'] == "activado") {$controller -> mostrar_activado();} // Mostrar pantalla de activación de cuenta
        elseif($_GET['action'] == "reenviar") {$controller -> mostrar_reactivado();} // Mostrar pantalla para reenviar email de activación de cuenta
        
        
    } 
            
    /* CONTROLADOR DE USUARIO */
    elseif ($_GET['controller'] == "usuario") {
    	
    	$controller = new controlador_usuario();
       
       if($_GET['action'] == "crear"){$controller -> crear();}
       elseif($_GET['action'] == "login"){$controller -> login();}
       elseif($_GET['action'] == "activar") {$controller -> activar_cuenta();}
       elseif($_GET['action'] == "resendmail") {$controller -> reenviar_mail();}
       elseif($_GET['action'] == "salir") {$controller -> cerrar();} 
    
    }
    
    
    /* CONTROLADOR DE POST */
    elseif ($_GET['controller'] == "post") {
    	
    	$controller = new controlador_post();
    	
    	if($_GET['action'] == "crear_post"){$controller -> crear_post();}
    	elseif($_GET['action'] == "editar_post"){$controller -> editar_post();}
    	elseif($_GET['action'] == "comentar"){$controller -> comentar();}
    	elseif($_GET['action'] == "editarComentario"){$controller -> editarMensaje();}
    	elseif($_GET['action'] == "borrarPost"){$controller -> borrar_post();}
    	elseif($_GET['action'] == "borrarMensaje"){$controller -> borrar_mensaje();}
    	elseif($_GET['action'] == "cerrarTema"){$controller -> cerrar_tema();}
    	elseif($_GET['action'] == "addpin"){$controller -> add_del_pin();}
    	
    	
    }
} 

/* DEFAULT START -> Pantalla principal */
else {
    $controller = new controlador_vistas();
    $controller -> indice();
}
