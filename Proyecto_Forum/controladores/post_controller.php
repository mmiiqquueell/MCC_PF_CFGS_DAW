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
		if(!$contestar){header("Location: index.php?controller=vistas&action=tema&idp=".$_SESSION['idp']."&idt=".$_SESSION['idt']."&idst=".$_SESSION['idst']."");}
		else{echo "Se ha producido un error al añadir el comentario, por favor intentelo más tarde";}
	}
	
}

?>