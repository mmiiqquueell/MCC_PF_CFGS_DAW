<?php

/**
* Controlador de post/mensajes.
* @autor Miquel Costa.
*/

require_once("modelos/post_model.php");

class controlador_post 
{
   /**
    * Función que permite añadir comentarios a los POST y devuelve al usuario al mensaje que ha escrito.
    */
	public function comentar()
	{
		$uid = $_SESSION['uid'];
		$post = $_GET['idp'];
		$mensaje = $_POST['mensaje'];
		$responder_post = new modelo_post();
		$responder_post -> setUid($uid);
		$responder_post -> setIdp($post);
		$responder_post -> setMensaje($mensaje);
		$contestar = $responder_post -> responder_mensaje();
		$identificador = $responder_post -> obtener_mensaje();
		$fechas = $responder_post -> obtener_fecha_mensaje();
		$responder_post -> setFecha($fechas['creacion']);
		$actualizado = $responder_post->actualizar_fecha();
		if(!$contestar){header("Location: index.php?controller=vistas&action=tema&idp=".$_SESSION['idp']."&idt=".$_SESSION['idt']."&idst=".$_SESSION['idst']."#".$identificador['id']."");}
		else{echo "Se ha producido un error al añadir el comentario, por favor, intentelo más tarde.";}
	}
	
	/**
	 * Función que permite editar mensajes
	 */
	public function editarMensaje()
	{
		$uid = $_SESSION['uid'];
		$post = $_GET['idp'];
		$mid = $_GET['mid'];
		$mensaje = $_POST['mensaje'];
		$editar_mensaje = new modelo_post();
		$editar_mensaje-> setUid($uid);
		$editar_mensaje-> setIdp($post);
		$editar_mensaje-> setId($mid);
		$editar_mensaje-> setMensaje($mensaje);
		$modificado = $editar_mensaje -> editar_mensaje();
		if(!$modificado){header("Location: index.php?controller=vistas&action=tema&idp=".$_SESSION['idp']."&idt=".$_SESSION['idt']."&idst=".$_SESSION['idst']."#".$mid."");}
		else{echo "Se ha producido un error al editar el comentario, por favor, intentelo más tarde.";}
	}
	
	/**
	 * Función que permite crear post
	 */
	public function crear_post()
	{
		$idst = $_POST['idst'];
		$idt = $_POST['idt'];
		$uid = $_SESSION['uid'];
		$titulo = $_POST['titulo'];
		$mensaje = $_POST['mensaje'];
		$crear_post = new modelo_post();
		$crear_post -> setUid($uid);
		$crear_post -> setIdp($idst);
		$crear_post -> setTitulo($titulo);
		$crear_post -> setMensaje($mensaje);
		$creado = $crear_post -> crear_tema();
		$idp = $crear_post -> obtener_post();
		if(!$creado){header("Location: index.php?controller=vistas&action=tema&idp=".$idp['id']."&idt=".$idt."&idst=".$idst."");}
		else{echo "Se ha producido un error al crear el tema, por favor, intentelo más tarde.";}
	}
	
	/**
	 * Función que permite editar los post
	 */
	public function editar_post()
	{
		$idst = $_POST['idst'];
		$idt = $_POST['idt'];
		$idp = $_POST['idp'];
		$uid = $_SESSION['uid'];
		$titulo = $_POST['titulo'];
		$mensaje = $_POST['mensaje'];
		$editar_post = new modelo_post();
		$editar_post-> setUid($uid);
		$editar_post-> setIdp($idp);
		$editar_post-> setId($idst);
		$editar_post-> setTitulo($titulo);
		$editar_post-> setMensaje($mensaje);
		$modificado = $editar_post-> editar_tema();
		
		if(!$modificado){header("Location: index.php?controller=vistas&action=tema&idp=".$idp."&idt=".$idt."&idst=".$idst."");}
		else{echo "Se ha producido un error al editar el tema, por favor, intentelo más tarde.";}
	}
	
	/**
	 * Función que permite borrar un post si no tiene comentarios
	 */
	public function borrar_post()
	{
		$idp = $_GET['idp'];
		$borrar_post = new modelo_post();
		$borrar_post -> setIdp($idp);
		$error = $borrar_post -> delete_post();
		if($error){header("Location: index.php?controller=vistas&action=subindice&idt=".$_SESSION['idt']."&idst=".$_SESSION['idst']."");}
		else {echo "Se ha producido un error al intentar borrar el tema, por favor, intentelo más tarde.";}
	}
	
	/**
	 * Función que borra el mensaje y lo bloquea de forma permanente
	 */
	public function borrar_mensaje()
	{
		$uid = $_SESSION['uid'];
		$post = $_GET['idp'];
		$mid = $_GET['mid'];
		$mensaje = "El usuario ha eliminado el mensaje.";
		$editar_mensaje = new modelo_post();
		$editar_mensaje-> setUid($uid);
		$editar_mensaje-> setIdp($post);
		$editar_mensaje-> setId($mid);
		$editar_mensaje-> setMensaje($mensaje);
		$modificado = $editar_mensaje -> delete_mensaje();
		if(!$modificado){header("Location: index.php?controller=vistas&action=tema&idp=".$_SESSION['idp']."&idt=".$_SESSION['idt']."&idst=".$_SESSION['idst']."#".$mid."");}
		else{echo "Se ha producido un error al editar el comentario, por favor, intentelo más tarde.";}
	}
	
	/**
	 * Solo administradores: Función que permite cerrar un post.
	 */
	public function cerrar_tema()
	{
		$idp = $_GET['idp'];
		$cerrar_tema = new modelo_post();
		$cerrar_tema -> setIdp($idp);
		$cerrado = $cerrar_tema -> tema_cerrado();
		if($cerrado){header("Location: index.php?controller=vistas&action=tema&idp=".$_SESSION['idp']."&idt=".$_SESSION['idt']."&idst=".$_SESSION['idst']."");}
		else {echo "Se ha producido un error al intentar borrar el tema, por favor, intentelo más tarde.";}
	}
	
	/**
	 * Solo administradores: Función que permite anclar un post.
	 */
	public function add_del_pin()
	{
		$idp = $_GET['idp'];
		$pin = $_GET['pin'];
		$add_pin = new modelo_post();
		$add_pin -> setIdp($idp);
		$add_pin -> setPin($pin);
		$anclado = $add_pin -> tema_pin();
		if(!$anclado){header("Location: index.php?controller=vistas&action=tema&idp=".$_SESSION['idp']."&idt=".$_SESSION['idt']."&idst=".$_SESSION['idst']."");}
		else{echo "Se ha producido un error al editar el comentario, por favor, intentelo más tarde.";}
	}
}

?>