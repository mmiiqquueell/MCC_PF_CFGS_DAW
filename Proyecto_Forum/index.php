<?php
session_start();
require_once("base_de_datos/db.php");
require_once("controladores/view_controller.php");
require_once("controladores/user_controller.php");


if (isset($_GET['controller']) && isset($_GET['action'])) {
    
    /* CONTROLADOR DE VISTAS */
    if ($_GET['controller'] == "vistas") {
        
        $controller = new controlador_vistas();
        
        if($_GET['action'] == "indice") {$controller -> indice();} // Mostrar temas principales
        elseif($_GET['action'] == "indica") {$controller -> indica();} // Mostrar temas principales separados
        elseif($_GET['action'] == "subindice") {$controller -> mostrar_subindice();} // Mostrar SubTemas
        elseif($_GET['action'] == "pantalla_login") {$controller -> pantalla_login();} // Mostrar pantalla de login
        elseif($_GET['action'] == "registrar") {$controller -> registrar();} // Mostrar pantalla de registro
        elseif($_GET['action'] == "perfil") {$controller -> mostrar_perfil();} // Mostrar pantalla de perfil
        elseif($_GET['action'] == "nuevoTema") {$controller -> mostrar_crear_tema();} // Mostrar pantalla de nuevo tema
        elseif($_GET['action'] == "responder") {$controller -> mostrar_responder();} // Mostrar pantalla de responder tema
        elseif($_GET['action'] == "editar") {$controller -> mostrar_editar();} // Mostrar pantalla de editar mensaje
        elseif($_GET['action'] == "master") {$controller -> mostrar_master();} // Mostrar pantalla de administración
        
    } 
            
    /* CONTROLADOR DE USUARIO */
    elseif ($_GET['controller'] == "usuario") {
    	
    	$controller = new controlador_usuario();
       
       if($_GET['action'] == "crear"){$controller -> crear();}
       if($_GET['action'] == "login"){$controller -> login();}
    
    }
} 

/* DEFAULT START -> Pantalla principal */
else {
    $controller = new controlador_vistas();
    $controller -> indice();
}
