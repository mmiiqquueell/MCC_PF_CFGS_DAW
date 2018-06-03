<?php

/**
* Modelo de usuarios.
* @autor Miquel Costa.
*/

class modelo_usuario{    
    
    /* Conector a la base de datos */
    public function __construct(){$this -> db = Conectar::conexion();}
    
    /**
     * Getters y Setters.
     */
    public function getNombre() {return $this -> nombre;}
    public function setNombre($nombre) {$this -> nombre = $nombre;}
    public function getEmail() {return $this -> email;}
    public function setEmail($email) {$this -> email = $email;}
    public function getPassword() {return $this -> password;}
    public function setPassword($password) {$this -> password = $password;}
    public function getNivel() {return $this -> nivel;}
    public function setNivel($nivel) {$this -> nivel = $nivel;}
    public function getId() {return $this -> id;}
    public function setId($id) {$this -> id = $id;}
    public function getPreferencias() {return $this -> preferencias;}
    public function setPreferencias($preferencias) {$this -> preferencias = $preferencias;}
       
    
    /**
     * Inserta un nuevo usuario a la base de datos.
     */
    public function crear_usuario()
    {
    	$salt = '$6$rounds=5000$mcc91pfcfgs17daw$';
    	$hashed_password = crypt($this -> password, $salt);
    	$stmt = $this->db->prepare("INSERT INTO usuarios (nombre, password, mail, validar, nivel) VALUES (?,?,?,?,10);");
    	$stmt -> bind_param('ssss', $this->nombre, $hashed_password, $this->email, $this->id);
    	$stmt -> execute();
    	$result = $stmt->get_result();
    	if ($this->db->error){return "$sql<br>{$this->db->error}";}
    	else {return false;}
    }
    
    public function get_user_id()
    {
    	$consulta=$this->db->query("SELECT id FROM usuarios WHERE nombre = '{$this->nombre}';");
    	while($filas=$consulta->fetch_assoc()){$this->id=$filas;}
    	return $this->id;
    }
    
    public function crear_usuario2()
    {
    	$sql="INSERT INTO preferencias (usuario,avatar,firma,tema,sexo,biografia,steam,playstation,xboxlive,nintendo,edad,mensajes,estilofecha,zonahoraria,paginaweb,ordenmensajes) VALUES ('{$this->id}','avatar_default.jpg',NULL,'Oficial','No mostrar',NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,NULL,'Ascendiente')";
    	$result = $this->db->query($sql);
    	if ($this->db->error){return "$sql<br>{$this->db->error}";}
    	else {return false;}
    }
    
    /**
     * Devuelve el valor del nombre para saber si ya existe un usuario con dicho nombre.
     * @return boolean devuelve true si existe, false si no existe.
     */
    public function get_user()
    {
    	$sql="SELECT nombre FROM usuarios WHERE id = '{$this->id}';";
    	$result = $this->db->query($sql);
    	if ($result -> num_rows > 0) {return true;}
    	else {return false;}
    }
    
    /**
     * Devuelve el valor del email para saber si ya existe un usuario con dicho email.
     * @return boolean devuelve true si existe, false si no existe.
     */
    public function get_mail()
    {
    	$sql="SELECT mail FROM usuarios WHERE mail = '{$this->email}';";
    	$result = $this->db->query($sql);
    	if ($result -> num_rows > 0) {return true;}
    	else {return false;}
    }
    
    /**
     * 
     * @return unknown
     */
    public function get_mail2()
    {
    	$consulta=$this->db->query("SELECT mail, nivel, validar FROM usuarios WHERE mail = '{$this->email}';");
    	while($filas=$consulta->fetch_assoc()){$this->email=$filas;}
    	return $this->email;
    }
        
    /**
     * Comprueba el nivel del usuario.
     */
    public function verificar_nivel()
    {
    	$consulta=$this->db->query("SELECT nivel FROM usuarios WHERE nombre = '{$this -> nombre}';");
    	while($filas=$consulta->fetch_assoc()){$this->nivel=$filas;}
    	return $this->nivel;
    }
        
    /**
     * Función para hacer login.
     */
    public function login()
    {
    	$salt = '$6$rounds=5000$mcc91pfcfgs17daw$';
        $hashed_password = crypt($this -> password, $salt);
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE nombre = ? AND password = ?");
        $stmt -> bind_param('ss', $this->nombre, $hashed_password);
        $stmt -> execute();
        $result = $stmt->get_result(); 
        if ($result -> num_rows > 0) {return true;}
        else {return false;}
    }
    
    public function activar_cuenta()
    {
    	$sql = "UPDATE usuarios SET nivel = 11 WHERE validar = '{$this -> id}';";
    	$result = $this->db->query($sql);
    	if ($result){return true;}
    	else {return false;}
    }
    
    public function verificar_activacion()
    {
    	$consulta=$this->db->query("SELECT nivel FROM usuarios WHERE validar = '{$this -> id}';");
    	while($filas=$consulta->fetch_assoc()){$this->nivel=$filas;}
    	return $this->nivel;
    }
    
    public function check_key()
    {
    	$consulta=$this->db->query("SELECT validar FROM usuarios;");
    	while($filas=$consulta->fetch_assoc()){$this->id[]=$filas;}
    	return $this->id;
    }
    
    public function get_preferencias()
    {
    	$consulta=$this->db->query("SELECT * FROM preferencias WHERE usuario = '{$this->id}';");
    	while($filas=$consulta->fetch_assoc()){$this->preferencias=$filas;}
    	return $this->preferencias;
    }
}
