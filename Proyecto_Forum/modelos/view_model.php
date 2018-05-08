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
    public function getIdt() {return $this->idt;}
    public function setIdt($idt) {$this->idt = $idt;}
    public function getIdst() {return $this->idst;}
    public function setIdst($idst) {$this->idst = $idst;}    
    public function getIdp() {return $this->idp;}
    public function setIdp($idp) {$this->idp = $idp;}
    public function getTema() {return $this->tema;}
    public function setTema($temas) {$this->tema = $tema;}
    public function getTemas() {return $this->temas;}
    public function setTemas($temas) {$this->temas = $temas;}
    public function getSubtemas() {return $this->subtemas;}
    public function setSubtemas($subtemas) {$this->subtemas = $subtemas;}
    public function getSubtema() {return $this->subtema;}
    public function setSubtema($subtema) {$this->subtema = $subtema;}
    public function getContapost() {return $this->contapost;}
    public function setContapost($contapost) {$this->contapost= $contapost;}
    public function getPost() {return $this->post;}
    public function setPost($post) {$this->post= $post;}
    public function getMSGT() {return $this->msgt;}
    public function setMSGT($msgt) {$this->msgt= $msgt;}
    public function getMSG() {return $this->msg;}
    public function setMSG($msg) {$this->msg= $msg;}
    public function getUsers() {return $this->users;}
    public function setUsers($users) {$this->users= $users;}
    public function getPreferencias() {return $this->preferencias;}
    public function setPreferencias($preferencias) {$this->preferencias= $preferencias;}
    
    
    /**
     * Devuelve el nombre los temas existentes para listarlos en el indice general.
     * @return devuelve los temas existentes.
     */
    public function listar_temas(){
    	$consulta=$this->db->query("SELECT * FROM temas ORDER BY nombre ASC;");
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
    
    
    public function contador_post(){
    	$consulta=$this->db->query("SELECT * FROM post;");
    	while($filas=$consulta->fetch_assoc()){$this->contapost[]=$filas;}
    	return $this->contapost;
    }
    
    public function contador_mensajes_totales(){
    	$consulta=$this->db->query("SELECT * FROM mensajes;");
    	while($filas=$consulta->fetch_assoc()){$this->msgt[]=$filas;}
    	return $this->msgt;
    }
    
    public function mostrar_posts(){
    	$consulta=$this->db->query("SELECT * FROM post WHERE subtema = '{$this->idst}';");
    	while($filas=$consulta->fetch_assoc()){$this->subtemas[]=$filas;}
    	return $this->subtemas;
    }
    
    public function listar_subtema(){
    	$consulta=$this->db->query("SELECT * FROM subtemas WHERE id = '{$this->idst}';");
    	while($filas=$consulta->fetch_assoc()){$this->subtema=$filas;}
    	return $this->subtema;
    } 
    
    public function get_user(){
    	$consulta=$this->db->query("SELECT * FROM usuarios;");
    	while($filas=$consulta->fetch_assoc()){$this->users[]=$filas;}
    	return $this->users;
    }
    
    public function mostrar_post(){
    	$consulta=$this->db->query("SELECT * FROM post WHERE id = '{$this->idp}';");
    	while($filas=$consulta->fetch_assoc()){$this->post=$filas;}
    	return $this->post;
    }
    
    public function mostrar_mensajes(){
    	$consulta=$this->db->query("SELECT * FROM mensajes WHERE post = '{$this->idp}';");
    	while($filas=$consulta->fetch_assoc()){$this->msg[]=$filas;}
    	return $this->msg;
    }
    
    public function mostrar_preferencias(){
    	$consulta=$this->db->query("SELECT * FROM preferencias;");
    	while($filas=$consulta->fetch_assoc()){$this->preferencias[]=$filas;}
    	return $this->preferencias;
    }
    
}
