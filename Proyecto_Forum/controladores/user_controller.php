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
		
		for ($i = 0; $i < count($key); $i++){ // Genera un ID unico y comprueba si existe en la base de datos, si existe se volvera a generar otro ID.
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
			if (!$error) { // Si el crear usuario es totalmente correcto se envia un mail al usuario para validar la cuenta.
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
	 * Permite al usuario iniciar sesión siempre y cuando cumpla los requisitos.
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
	
	/**
	 * Cierra la sesión del usuario.
	 */
	public function cerrar()
	{
		session_unset();
		session_destroy();
		header("Location: index.php");
	}
	
	/**
	 * Valdia de cuenta de usuario y permite utilizarla
	 */
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
	
	/**
	 * Si el usuario pierde el email de activación puede volver a solicitar otro email.
	 */
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
	
	/** 
	 * Guarda las preferencias del usuario
	 */
	public function guardar_config()
	{
		$obtener_temas = new modelo_vistas();
		$obtener_usuario = new modelo_usuario();
		$temas = $obtener_temas -> listar_temas();
		$obtener_usuario -> setId($_SESSION['uid']);
		$usuario = $obtener_temas -> get_user();
		$preferencias = $obtener_usuario -> get_preferencias();
		
		
		if($_FILES['IMG1']['size'] == 0){}
		else{
			$info = pathinfo($_FILES['IMG1']['name']);
			$ext = $info['extension'];
			$newname = $_SESSION['user'].'.'.$ext;
			$target = 'images/avatares/'.$newname;
			move_uploaded_file($_FILES['IMG1']['tmp_name'], $target);
		};		
		if($_POST['firma'] != $preferencias['firma']){$obtener_usuario -> setFirma($_POST['firma']);} else{$obtener_usuario -> setFirma($preferencias['firma']);};
		if($_POST['bio'] != $preferencias['biografia']){$obtener_usuario -> setBiografia($_POST['bio']);} else{$obtener_usuario -> setBiografia($preferencias['biografia']);};
		if($_POST['edad'] != $preferencias['edad']){$obtener_usuario -> setEdad($_POST['edad']);} else{$obtener_usuario -> setEdad($preferencias['edad']);};
		if($_POST['sexo'] != $preferencias['sexo']){$obtener_usuario -> setSexo($_POST['sexo']);} else{$obtener_usuario -> setSexo($preferencias['sexo']);};
		if($_POST['web'] != $preferencias['paginaweb']){$obtener_usuario -> setPaginaweb($_POST['web']);} else{$obtener_usuario -> setPaginaweb($preferencias['paginaweb']);};
		if($_POST['nintendo'] != $preferencias['nintendo']){$obtener_usuario -> setNintendo($_POST['nintendo']);} else{$obtener_usuario -> setNintendo($preferencias['nintendo']);};
		if($_POST['sony'] != $preferencias['playstation']){$obtener_usuario -> setPlaystation($_POST['sony']);} else{$obtener_usuario -> setPlaystation($preferencias['playstation']);};
		if($_POST['steam'] != $preferencias['steam']){$obtener_usuario -> setSteam($_POST['steam']);} else{$obtener_usuario -> setSteam($preferencias['steam']);};
		if($_POST['xlive'] != $preferencias['xboxlive']){$obtener_usuario -> setXboxlive($_POST['xlive']);} else{$obtener_usuario -> setXboxlive($preferencias['xboxlive']);};
		//if($_POST['oldPW'] == ''){};
		//if($_POST['newPW'] == ''){};
		if($_POST['tema'] != $preferencias['tema']){$obtener_usuario -> setTema($_POST['tema']);} else{$obtener_usuario -> setTema($preferencias['tema']);};
		if($_POST['fecha'] != $preferencias['estilofecha']){$obtener_usuario -> setEstilofecha($_POST['fecha']);} else{$obtener_usuario -> setEstilofecha($preferencias['estilofecha']);};
		if($_POST['horario'] != $preferencias['zonahoraria']){$obtener_usuario -> setZonahoraria($_POST['horario']);} else{$obtener_usuario -> setZonahoraria($preferencias['zonahoraria']);};
		if($_POST['cantidad'] != $preferencias['mensajes']){$obtener_usuario -> setMensajes($_POST['cantidad']);} else{$obtener_usuario -> setMensajes($preferencias['mensajes']);};
		if($_POST['ordenar'] != $preferencias['ordenmensajes']){$obtener_usuario -> setOrdenmensajes($_POST['ordenar']);} else{$obtener_usuario -> setOrdenmensajes($preferencias['ordenmensajes']);};
		$error = $obtener_usuario -> actualizar_preferencias();
		if($temas && $preferencias && !$error){header("Location: index.php?controller=vistas&action=perfil");}
		else{header("Location: vistas/perfil.php&error1");}	
	}
	
}