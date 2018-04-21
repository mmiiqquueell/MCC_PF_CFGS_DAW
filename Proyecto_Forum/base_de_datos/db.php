<?php

/**
 * Función para conectar a la base de datos.
 * @autor Miquel Costa.
 */

class Conectar {
    
    /**
     * Conexión a la base de datos
     * @return bolean, devuelve true o false
     */
    public static function conexion() {
        $conexion=new mysqli("none", "none", "none", "none"); // Por seguridad no se mostrara los nombres de las conexiones a la base de datos en GIT.
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}
