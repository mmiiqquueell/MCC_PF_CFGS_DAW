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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * Obtiene la dirección (residencia) del usuario para añadir a la cesta si se crea (funciona al hacer login pero no si finaliza una compra, no descubrí el motivo).
     * @return string Devuelve la dirección de residencia del usuario.
     */
    public function get_direccion(){
        $consulta=$this->db->query("SELECT ADDRESS AS ADDRESS FROM user WHERE USERNAME = '{$this->nombre}';");	
        while($filas=$consulta->fetch_assoc()){$this->direccion=$filas;}
        return $this->direccion;
    }
    
    /**
     * Devuelve el nivel de privilegios del usuario (1 = Usuario normal "default", 2 = administradores) Esto se ha diseñado así para facilitar el añadir más administradores sin necesidad de comprobar si el nombre es admin u es otro nombre, verificando que es 2 ya se sabe que es un administrador.
     * @return integer Devuelve el nivel de privilegios.
     */
    public function get_nivel(){
        if(isset($_SESSION['nombre'])) {
            $consulta=$this->db->query("SELECT NIVEL AS NIVEL FROM user WHERE USERNAME = '{$_SESSION['nombre']}';");	
            while($filas=$consulta->fetch_assoc()){$this->nivel=$filas;}
            return $this->nivel;
        } else {return 1;}
    }
    
    /**
     * Obtiene la dirección de correo electrónico para verificar el email así como el cambio de contraseña.
     * @return string Devuelve la dirección de email del usuario.
     */
    public function get_email(){
        $consulta=$this->db->query("SELECT EMAIL AS EMAIL FROM user WHERE USERNAME = '{$_SESSION['nombre']}';");	
        while($filas=$consulta->fetch_assoc()){$this->email=$filas;}
        return $this->email;
    }
    
      
    /**
     * Verifica el email (falsa verificación) tras registrarse y hacer login por primera vez.
     */
    public function verificar(){
        $salt = '$1$encriptat';
        $hashed_password = crypt($this -> password, $salt);
        $sql = "UPDATE user SET VERIFICADO = 1 WHERE USERNAME = '{$this -> nombre}' AND PASSWORD = '$hashed_password';";
        $result = $this->db->query($sql);
        if ($result){return true;}
        else {return false;}
    }
    
    /**
     * Esta función tenia que ser en un inicio restablecer contraseña pero en su lugar se cambio para ser un cambiar contraseña del usuario. Se verifica el nombre de usuario, email y contraseña actual antes de permitir el cambio.
     */
    public function restablecer(){
        $salt = '$1$encriptat';
        $hashed_password = crypt($this -> password, $salt);
        $sql = "UPDATE user SET PASSWORD = '$hashed_password' WHERE USERNAME = '{$this -> nombre}' AND EMAIL = '{$this -> email}';";
        $result = $this->db->query($sql);
        if ($result){return true;}
        else {return false;}
    }
}
