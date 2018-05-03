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
       
    
    /**
     * Inserta un nuevo usuario a la base de datos.
     */
    public function crear_usuario(){
    	$salt = '$6$rounds=5000$mcc91pfcfgs17daw$';
    	$hashed_password = crypt($this -> password, $salt);
    	$stmt = $this->db->prepare("INSERT INTO usuarios (nombre, password, mail, validar, nivel) VALUES (?,?,?,?,10);");
    	$stmt -> bind_param('ssss', $this->nombre, $hashed_password, $this->email, $this->id);
    	$stmt -> execute();
    	$result = $stmt->get_result();
    	if ($this->db->error){return "$sql<br>{$this->db->error}";}
    	else {return false;}
    }
    
    /**
     * Devuelve el valor del nombre para saber si ya existe un usuario con dicho nombre.
     * @return boolean devuelve true si existe, false si no existe.
     */
    public function get_user(){
    	$sql="SELECT nombre FROM usuarios WHERE nombre = '{$this->nombre}';";
    	$result = $this->db->query($sql);
    	if ($result -> num_rows > 0) {return true;}
    	else {return false;}
    }
    
    /**
     * Devuelve el valor del email para saber si ya existe un usuario con dicho email.
     * @return boolean devuelve true si existe, false si no existe.
     */
    public function get_mail(){
    	$sql="SELECT mail FROM usuarios WHERE mail = '{$this->email}';";
    	$result = $this->db->query($sql);
    	if ($result -> num_rows > 0) {return true;}
    	else {return false;}
    }
        
    /**
     * Comprueba el nivel del usuario.
     */
    public function verificar_nivel(){
    	$consulta=$this->db->query("SELECT nivel FROM usuarios WHERE nombre = '{$this -> nombre}';");
    	while($filas=$consulta->fetch_assoc()){$this->nivel=$filas;}
    	return $this->nivel;
    }
        
    /**
     * Función para hacer login.
     */
    public function login(){
    	$salt = '$6$rounds=5000$mcc91pfcfgs17daw$';
        $hashed_password = crypt($this -> password, $salt);
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE nombre = ? AND password = ?");
        $stmt -> bind_param('ss', $this->nombre, $hashed_password);
        $stmt -> execute();
        $result = $stmt->get_result(); 
        if ($result -> num_rows > 0) {return true;}
        else {return false;}
    }
}
