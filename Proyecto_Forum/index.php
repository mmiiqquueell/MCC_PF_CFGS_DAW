<?php
session_start();
require_once("base_de_datos/db.php");
require_once("controladores/view_controller.php");


if (isset($_GET['controller']) && isset($_GET['action'])) {
    
    /* CONTROLADOR DE VISTAS */
    if ($_GET['controller'] == "vistas") {
        
        $controller = new controlador_vistas();
        
        if($_GET['action'] == "indice") {$controller -> indice();}
       
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
       
    
    }
} 

/* DEFAULT START -> Pantalla de LOGIN */
else {
    $controller = new controlador_vistas();
    $controller -> seguridad_temporal();
}
