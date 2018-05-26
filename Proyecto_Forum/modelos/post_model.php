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
    public function getId() {return $this -> id;}
    public function setId($id) {$this -> id = $id;}
    public function getIdp() {return $this -> idp;}
    public function setIdp($idp) {$this -> idp = $idp;}
    public function getUid() {return $this -> uid;}
    public function setUid($uid) {$this -> uid = $uid;}    
    public function getTitulo() {return $this -> titulo;}
    public function setTitulo($titulo){$this -> titulo = $titulo;}
    public function getMensaje() {return $this -> mensaje;}
    public function setMensaje($mensaje){$this -> mensaje = $mensaje;}
    public function getFecha() {return $this -> fecha;}
    public function setFecha($fecha){$this -> fecha = $fecha;}
    
    
    
    public function responder_mensaje()
    {
    	$stmt = $this->db->prepare("INSERT INTO mensajes (usuario, mensaje, post, modificado) VALUES ('{$this->uid}',?,'{$this->idp}', NULL);");
    	$stmt -> bind_param('s', $this->mensaje); 
    	$stmt -> execute();
    	$result = $stmt->get_result();
    	if ($this->db->error){return "$sql<br>{$this->db->error}";}
    	else {return false;}
    }
    
    public function editar_mensaje()
    {
    	$stmt = $this->db->prepare("UPDATE mensajes SET mensaje = ? WHERE usuario = '{$this->uid}' AND post = '{$this->idp}' AND id = '{$this->id}';");
    	$stmt -> bind_param('s', $this->mensaje);
    	$stmt -> execute();
    	$result = $stmt->get_result();
    	if ($this->db->error){return "$sql<br>{$this->db->error}";}
    	else {return false;}
    }
    
    public function obtener_fecha_mensaje()
    {
    	$consulta=$this->db->query("SELECT creacion FROM mensajes WHERE post = '{$this->idp}' AND usuario = '".$_SESSION['uid']."' ORDER BY creacion DESC LIMIT 1;");
    	while($filas=$consulta->fetch_assoc()){$this->fecha=$filas;}
    	return $this->fecha;
    }
    
    public function obtener_fecha_editar_mensaje()
    {
    	$consulta=$this->db->query("SELECT modificado FROM mensajes WHERE post = '{$this->idp}' AND usuario = '".$_SESSION['uid']."' ORDER BY creacion DESC LIMIT 1;");
    	while($filas=$consulta->fetch_assoc()){$this->fecha=$filas;}
    	return $this->fecha;
    }
    
    
    public function actualizar_fecha()
    {
    	$sql = "UPDATE post SET ultima_fecha = '{$this->fecha}' WHERE id = '{$this->idp}';";
    	$result = $this->db->query($sql);
    	if ($result){return true;}
    	else {return false;}
    }
    
    public function crear_tema()
    {
    	$stmt = $this->db->prepare("INSERT INTO post (subtema, titulo, mensaje, creador) VALUES ('{$this->idp}',?,?,'{$this->uid}');");
    	$stmt -> bind_param('ss', $this->titulo, $this->mensaje);
    	$stmt -> execute();
    	$result = $stmt->get_result();
    	if ($this->db->error){return "$sql<br>{$this->db->error}";}
    	else {return false;}
    }
    
    public function editar_tema()
    {
    	$stmt = $this->db->prepare("UPDATE post SET titulo = ?, mensaje = ? WHERE id = '{$this->idp} AND creador = {$this->uid}' AND subtema = '{$this->id}';");
    	$stmt -> bind_param('ss', $this->titulo, $this->mensaje);
    	$stmt -> execute();
    	$result = $stmt->get_result();
    	if ($this->db->error){return "$sql<br>{$this->db->error}";}
    	else {return false;}
    }
    public function obtener_post()
    {
    	$consulta=$this->db->query("SELECT id FROM post WHERE creador = '{$this->uid}' ORDER BY creador DESC LIMIT 1;");
    	while($filas=$consulta->fetch_assoc()){$this->id=$filas;}
    	return $this->id;
    }
    
    public function obtener_mensaje()
    {
    	$consulta=$this->db->query("SELECT id FROM mensajes WHERE usuario = '{$this->uid}' ORDER BY usuario DESC LIMIT 1;");
    	while($filas=$consulta->fetch_assoc()){$this->id=$filas;}
    	return $this->id;
    }
    
}
    