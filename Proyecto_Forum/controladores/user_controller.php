<?php

/**
* Controlador de usuarios.
* @autor Miquel Costa.
*/

require_once("modelos/user_model.php");

class controlador_usuario {
   
	/**
	 * Permite crear un nuevo usuario // Los filtros se hacen mediante JavaScript y posteriormente por mayor seguridad por PHP
	 */
	function crear(){
		$nombre = $_POST['usuario'];
		$email1 = $_POST['email'];
		$email2 = $_POST['remail'];
		$password1 = $_POST['password'];
		$password2 = $_POST['rpassword'];
		$cifrado = uniqid();
		if (strlen(trim($password1)) < 8) {header("Location: index.php?controller=vistas&action=registrar&error1");}
		elseif (!preg_match('/[a-z]/', $password1)) {header("Location: index.php?controller=vistas&action=registrar&error2");}
		elseif (!preg_match('/[A-Z]/', $password1)) {header("Location: index.php?controller=vistas&action=registrar&error3");}
		elseif (!preg_match('/[0-9]/', $password1)) {header("Location: index.php?controller=vistas&action=registrar&error4");}
		elseif (!preg_match('/[@\.\-_]/', $password1)) {header("Location: index.php?controller=vistas&action=registrar&error5");}
		elseif ($password1 !== $password2) {header("Location: index.php?controller=vistas&action=registrar&error6");}
		elseif ($email1 !== $email2) {header("Location: index.php?controller=vistas&action=registrar&error7");}
		$nuevo_usuario = new modelo_usuario();
		$nuevo_usuario -> setNombre($nombre);
		$nuevo_usuario -> setPassword($password1);
		$nuevo_usuario -> setEmail($email1);
		$nuevo_usuario -> setId($cifrado);
		$existe_nombre = $nuevo_usuario -> get_user();
		$existe_email = $nuevo_usuario -> get_mail();
		if($existe_nombre){header("Location: index.php?controller=vistas&action=registrar&error8");}
		elseif($existe_email) {header("Location: index.php?controller=vistas&action=registrar&error9");}
		else{
			$error = $nuevo_usuario -> crear_usuario();
			if (!$error) {header("Location: index.php?controller=vistas&action=registrar&info1");}
			else {header("Location: index.php?controller=vistas&action=registrar&error10");}
		}
	}    
	
	
	/**
	 * 
	 */
	public function login(){
		$nombre = $_POST['usuario'];
		$password = $_POST['password'];
		if(!isset($_SESSION['user'])){$_SESSION['user'] = $nombre;}
		if(!isset($_SESSION['cont'])){$_SESSION['cont'] = $password;}
		$userLogin = new modelo_usuario();
		$userLogin -> setNombre($nombre);
		$userLogin -> setPassword($password);
		$nivelUsuario = $userLogin->verificar_nivel();
		$_SESSION['nivel'] = $nivelUsuario['nivel'];
		if($nivelUsuario['nivel'] === '10'){header("Location: index.php?controller=vistas&action=pantalla_login&error1");}
		elseif($nivelUsuario['nivel'] === '0'){header("Location: index.php?controller=vistas&action=pantalla_login&error2");}
		elseif($nivelUsuario['nivel'] === '1'){header("Location: index.php?controller=vistas&action=pantalla_login&error3");}
		else{
			$iniciarSesion = $userLogin->login();
			if($iniciarSesion){header("Location: index.php");}
			else{header("Location: index.php?controller=vistas&action=pantalla_login&error4");}
		}
		
	}
	
	
	
}