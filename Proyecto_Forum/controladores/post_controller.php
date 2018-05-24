<?php

/**
* Controlador de post/mensajes.
* @autor Miquel Costa.
*/

require_once("modelos/post_model.php");

class controlador_post 
{
   
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
		else{echo "Se ha producido un error al añadir el comentario, por favor intentelo más tarde";}
	}
	
	
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
		else{echo "Se ha producido un error al añadir el comentario, por favor intentelo más tarde";}
	}
	
}

?>