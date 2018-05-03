<?php

/**
* Modelo de usuarios.
* @autor Miquel Costa.
*/

class modelo_vistas{    
    
    /* Conector a la base de datos */
    public function __construct(){$this -> db = Conectar::conexion();}
    
    /**
     * Getters y Setters.
     */
    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}
    public function getTema() {return $this->tema;}
    public function setTema($temas) {$this->tema = $tema;}
    public function getTemas() {return $this->temas;}
    public function setTemas($temas) {$this->temas = $temas;}
    public function getSubtemas() {return $this->subtemas;}
    public function setSubtemas($subtemas) {$this->subtemas = $subtemas;}
    
    
    /**
     * Devuelve el nombre los temas existentes para listarlos en el indice general.
     * @return devuelve los temas existentes.
     * SELECT temas.nombre, temas.descripcion, subtemas.categoria, subtemas.descripcion, post.titulo, usuarios.nombre, post.fecha_creacion FROM temas, subtemas, post, mensajes, usuarios WHERE temas.id = subtemas.padre AND subtemas.id = post.subtema AND post.creador = usuarios.id;
     */
    public function listar_temas(){
    	$consulta=$this->db->query("SELECT * FROM temas;");
    	while($filas=$consulta->fetch_assoc()){$this->temas[]=$filas;}
    	return $this->temas;
    }
    
    
    /**
     * Devuelve el nombre del tema seleccionado por el usuario.
     * @return Devuelve el tema seleccionado.
     */
    public function listar_tema(){
    	$consulta=$this->db->query("SELECT * FROM temas WHERE id = '{$this->id}';");
    	while($filas=$consulta->fetch_assoc()){$this->tema[]=$filas;}
    	return $this->tema;
    }

    /**
     * Devuelve el nombre los subtemas existentes para listarlos en el indice de subtemas.
     * @return devuelve los subtemas existentes.
     */
    public function listar_subtemas(){
    	$consulta=$this->db->query("SELECT * FROM subtemas;");
    	while($filas=$consulta->fetch_assoc()){$this->subtemas[]=$filas;}
    	return $this->subtemas;
    }    
}
