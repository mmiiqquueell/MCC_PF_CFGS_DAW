<?php

/**
* Controlador de usuarios.
* @autor Miquel Costa.
*/

require_once("modelos/user_model.php");

class controlador_usuario 
{
   
	/**
	 * Permite crear un nuevo usuario // Los filtros se hacen mediante JavaScript y posteriormente por mayor seguridad por PHP
	 */
	function crear()
	{
		$nombre = $_POST['usuario'];
		$email1 = $_POST['email'];
		$email2 = $_POST['remail'];
		$password1 = $_POST['password'];
		$password2 = $_POST['rpassword'];
		$nuevo_usuario = new modelo_usuario();
		$key = $nuevo_usuario -> check_key();
		
		for ($i = 0; $i < count($key); $i++){
			$cifrado = uniqid();
			if($cifrado == $key[$i]['validar']) {$cifrado = uniqid();}
			else {break;}
		}
		
		if (strlen(trim($password1)) < 8) {header("Location: index.php?controller=vistas&action=registrar&error1");}
		elseif (!preg_match('/[a-z]/', $password1)) {header("Location: index.php?controller=vistas&action=registrar&error2");}
		elseif (!preg_match('/[A-Z]/', $password1)) {header("Location: index.php?controller=vistas&action=registrar&error3");}
		elseif (!preg_match('/[0-9]/', $password1)) {header("Location: index.php?controller=vistas&action=registrar&error4");}
		elseif (!preg_match('/[@\.\-_]/', $password1)) {header("Location: index.php?controller=vistas&action=registrar&error5");}
		elseif ($password1 !== $password2) {header("Location: index.php?controller=vistas&action=registrar&error6");}
		elseif ($email1 !== $email2) {header("Location: index.php?controller=vistas&action=registrar&error7");}
		
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
			$nuevo_usuario -> setNombre($nombre);
			$id_user = $nuevo_usuario -> get_user_id();
			$nuevo_usuario -> setId($id_user['id']);
			$error2 = $nuevo_usuario -> crear_usuario2();
			if (!$error) {
				$para      = $email1;
				$titulo    = 'Activación de cuenta RGF';
				$mensaje   = 'Su cuenta ha sido creada pero para activarla debe pulsar en este link:' . "\r\n" . "http://www.mcc-daw.tk/index.php?controller=usuario&action=activar&cd=".$cifrado;
				$cabeceras = 'Content-Type: text/html; charset=UTF-8' . "\r\n" .
						'From: no-reply@RetroGamingForum.com' . "\r\n" .
						'Reply-to: no-reply@RetroGamingForum.com' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
				mail($para, $titulo, $mensaje, $cabeceras);		
				header("Location: index.php?controller=vistas&action=registrar&info1");}
			else {header("Location: index.php?controller=vistas&action=registrar&error10");}
		}
	}    
	
	
	/**
	 * 
	 */
	public function login()
	{
		$nombre = $_POST['usuario'];
		$password = $_POST['password'];
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
			if($iniciarSesion){
				$user_id = $userLogin->get_user_id();
				if(!isset($_SESSION['user'])){$_SESSION['user'] = $nombre;}
				if(!isset($_SESSION['cont'])){$_SESSION['cont'] = $password;}
				if(!isset($_SESSION['uid'])){$_SESSION['uid'] = $user_id['id'];}
				header("Location: index.php");
			}
			else{header("Location: index.php?controller=vistas&action=pantalla_login&error4");}
		}
		
	}
	
	
	public function cerrar()
	{
		session_unset();
		session_destroy();
		header("Location: index.php");
	}
	
	public function activar_cuenta() 
	{
		$cod = $_GET['cd']; 
		$obtener_usuario = new modelo_usuario();
		$obtener_usuario -> setId($cod);
		$valida = $obtener_usuario -> verificar_activacion();
		$validar = (int)$valida['nivel'];
		if($validar == '10'){
			$activado = $obtener_usuario -> activar_cuenta();
			if($activado){header('Location: index.php?controller=vistas&action=activado&act1');}
			else{echo "Se ha producido un error al activar la cuenta";};
		} elseif($validar > '10') {
			header('Location: index.php?controller=vistas&action=activado&act2');
		} elseif($validar < '10'){
			header('Location: index.php?controller=vistas&action=activado&act3');
		}
	}
	
	
	public function reenviar_mail()
	{
		$mail = $_POST['mail'];
		$obtener_usuario = new modelo_usuario();
		$obtener_usuario -> setEmail($mail);
		$existe = $obtener_usuario -> get_mail();
		if (!$existe){header("Location: index.php?controller=vistas&action=reenviar&error1");}
		else{
			$error = $obtener_usuario -> get_mail2();
			if ($error['nivel'] != '10'){header("Location: index.php?controller=vistas&action=reenviar&error2");}
			else {
				$para      = $mail;
				$titulo    = 'Activación de cuenta RGF';
				$mensaje   = 'Su cuenta ha sido creada pero para activarla debe pulsar en este link:' . "\r\n" . "<a href='http://www.mcc-daw.tk/index.php?controller=usuario&action=activar&cd=".$error['validar']."'>Pulsa aquí para activar la cuenta</a>";
				$cabeceras = 'Content-Type: text/html; charset=UTF-8' . "\r\n" .
						'From: no-reply@RetroGamingForum.com' . "\r\n" .
						'Reply-to: no-reply@RetroGamingForum.com' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
				mail($para, $titulo, $mensaje, $cabeceras);
				header("Location: index.php?controller=vistas&action=reenviar&info1");
			}
		}
	}
	
	
}