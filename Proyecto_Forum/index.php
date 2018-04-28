<?php
session_start();
require_once("base_de_datos/db.php");
require_once("controladores/view_controller.php");
require_once("controladores/user_controller.php");


if (isset($_GET['controller']) && isset($_GET['action'])) {
    
    /* CONTROLADOR DE VISTAS */
    if ($_GET['controller'] == "vistas") {
        
        $controller = new controlador_vistas();
        
        if($_GET['action'] == "indice") {$controller -> indice();}
        elseif($_GET['action'] == "pantalla_login") {$controller -> pantalla_login();}
        elseif($_GET['action'] == "registrar") {$controller -> registrar();}
        
       
    } 
    
    /* CONTROLADOR DE CATEGORIAS */
    elseif ($_GET['controller'] == "categoria") {
        
        
    }
     
    /* CONTROLADOR DE CESTA */
    elseif ($_GET['controller'] == "cesta") {
        
     
    } 
    
    /* CONTROLADOR DE PRODUCTO */
    elseif ($_GET['controller'] == "producto") {
        
        
    } 
        
    /* CONTROLADOR DE USUARIO */
    elseif ($_GET['controller'] == "usuario") {
    	
    	$controller = new controlador_usuario();
       
       if($_GET['action'] == "crear"){$controller -> crear();}
       if($_GET['action'] == "login"){$controller -> login();}
    
    }
} 

/* DEFAULT START -> Pantalla de LOGIN */
else {
    $controller = new controlador_vistas();
    $controller -> seguridad_temporal();
}
