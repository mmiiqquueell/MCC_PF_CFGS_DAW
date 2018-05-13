<?php

/**
* Modelo de post.
* @autor Miquel Costa.
*/

class modelo_post{    
    
    /* Conector a la base de datos */
    public function __construct(){$this -> db = Conectar::conexion();}
    
    /**
     * Getters y Setters.
     */
    public function getNombre() {return $this -> nombre;}
    public function setNombre($nombre) {$this -> nombre = $nombre;}
    public function getIdp() {return $this -> idp;}
    public function setIdp($idp) {$this -> idp = $idp;}
    public function getUid() {return $this -> uid;}
    public function setUid($uid) {$this -> uid = $uid;}
    public function getMensaje() {return $this -> mensaje;}
    public function setMensaje($mensaje){$this -> mensaje = $mensaje;}
    
    
    
    public function responder_mensaje()
    {
    	$stmt = $this->db->prepare("INSERT INTO mensajes (usuario, mensaje, post) VALUES ('{$this->uid}',?,'{$this->idp}');");
    	$stmt -> bind_param('s', $this->mensaje); 
    	$stmt -> execute();
    	$result = $stmt->get_result();
    	if ($this->db->error){return "$sql<br>{$this->db->error}";}
    	else {return false;}
    }
    
}
    