<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Retro Gaming Forum</title>
        <?php include "bootstrap.php"; ?>
    </head>
	<script>	
		// CÓDIGO RECICLADO DEL ANTERIOR PROYECTO //
		window.onload = function() { // Función que se ejecuta al cargar el HTML //
			var filtro = document.getElementById('filtro'), encendido = document.getElementById('CRT'), activo = true; // Almacena DIV en variables ademas de guardar un boolean //

            encendido.onclick = filtra; // Asigna una función al botón indicado //
            function filtra() { // La función activa o desactiva el efecto CRT (pantalla antigua) //
                if (activo) {filtro.style.transition = "1s"; filtro.style.opacity = "0"; activo = false;}
                else {filtro.style.transition = "1s"; filtro.style.opacity = "0.2"; activo = true;}
            }	
		}
	</script>
     <body class="container p-0">
        
        <?php include "header.php"; ?>
         <div id="filtro" class="filtro"></div>
         <main class="mt-3 col-12 row b-transluced text-dark p-0 text-left">
         
         
         <?php 
         // Casi no recuerdo que hacia cada parte...
         $men = 0; $idst = $_GET['idst']; $total_men = 0; $cerrado = 0; $del = 0;
         $_SESSION['idp'] = $_GET['idp']; $_SESSION['idt'] = $_GET['idt']; $_SESSION['idst'] = $_GET['idst'];
         
         // Obtiene los valores del creador del post y los almacena en diferentes variables
         for ($u = 0; $u < count($usuarios); $u++){
         	if($post['creador'] == $usuarios[$u]['id']) {$creador = $usuarios[$u]['nombre']; $registroC = $usuarios[$u]['registro']; $nivelC = $usuarios[$u]['nivel']; $cerrado = $post['cerrado'];
	         	for($i = 0; $i < count($preferencias); $i++){
	         		if($preferencias[$i]['usuario'] == $usuarios[$u]['id']) {$avatar = $preferencias[$i]['avatar']; $firmaC = $preferencias[$i]['firma'];}
	         	}
	         	for($j = 0; $j < count($MSG); $j++){
	         		if($MSG[$j]['usuario'] == $usuarios[$u]['id']){$total_men++;}
	         	}
	         	for($me = 0; $me < count($mensajes); $me++){
	         		if($mensajes[$me]['post'] == $_GET['idp']){$del++;}
	         	}
         	}
         	
         }
         foreach ($tema as $tema){ // Obtiene información del subtema así como los permisos segun si es administrador o usuario normal para añadir anclaje al post.
            	echo "
					<div class='col-12 row p-0 pb-2 b-transluced pl-lg-0 mx-auto'>
		                <div class='rounded mb-2 col-12 bg-warning-custom'>
		                    <h3 class='font-weight-bold'><a href='index.php?controller=vistas&action=indica&id=".$tema['id']."'>".$tema['nombre']."</a> > <a href='index.php?controller=vistas&action=subindice&idst=".$_GET['idst']."&idt=".$_GET['idt']."'>".$subtema['categoria']."</a></h3>
		                </div>
		                <div class='rounded col-12 row m-0 w-100 "; if($cerrado == 1) {echo "bg-dark-custom text-white";} else {echo "bg-info-custom";} echo " text-light'>
		                    <h4 class='col-11 font-weight-bold'>".$post['titulo']; 
            				if($cerrado == 1) {echo " > (TEMA CERRADO) </h4>";} elseif($cerrado == 0) {echo "</h4>";}
		                    if(intval($nivel['nivel']) >= 110 && intval($nivel['nivel']) < 200 && $post['pin'] == 0) {echo "<a href='index.php?controller=post&action=addpin&idp=".$_GET['idp']."&pin=1' class='col-1 border btn btn-info text-white my-auto'><span>ANCLAR</span></a>";} 
		                    elseif(intval($nivel['nivel']) >= 110 && intval($nivel['nivel']) < 200 && $post['pin'] == 1) {echo "<a href='index.php?controller=post&action=addpin&idp=".$_GET['idp']."&pin=0' class='col-1 border btn btn-info text-white my-auto'><span>DESANCLAR</span></a>";} 
		                echo "</div>
		            </div>";	
            };
            // Muestra el rago del creador del post así como título, mensaje, fecha, firma (si tiene), avatar, editar, eliminar post (si se puede).
            echo "
			<div class='col-12 row p-0 pb-2 b-transluced mx-auto'>
                <div class='RLT col-2 pt-1 pb-2 bg-warning text-center'>
					<h5 class='m-auto usuario rounded "; 
			            if ($nivelC == 0) { echo "u-ban' data-toggle='tooltip' data-placement='bottom' title='BANEADO'"; }
			            elseif($nivelC == 1) { echo "u-bot' data-toggle='tooltip' data-placement='bottom' title='BOT'"; }
			            elseif($nivelC == 100) { echo "u-cola' data-toggle='tooltip' data-placement='bottom' title='Colaborador'"; }
			            elseif($nivelC == 101) { echo "u-mod' data-toggle='tooltip' data-placement='bottom' title='Moderador'"; }
			            elseif($nivelC == 110) { echo "u-admin' data-toggle='tooltip' data-placement='bottom' title='Administrador'"; }
			            elseif($nivelC == 111) { echo "u-master' data-toggle='tooltip' data-placement='bottom' title='Web-Master'"; }
			            elseif($nivelC == 200) { echo "u-del' data-toggle='tooltip' data-placement='bottom' title='Cuenta eliminada'"; }
			            else{ echo "' data-toggle='tooltip' data-placement='bottom' title='Usuario'";}
            		echo ">".$creador."</h5>
                </div>
                <div class='RRT col-10 row p-2 pb-2 bg-light mx-auto'>
                    <span class='table-secondary-custom rounded col-9'>Mensaje enviado el ".date('d/m/Y H:i:s', strtotime($post['fecha_creacion']))."</span>";
            		if(isset($_SESSION['uid']) && $_SESSION['uid'] == $post['creador'] && $cerrado == 0 || intval($nivel['nivel']) >= 101 && intval($nivel['nivel']) < 200){
						echo "<a class='col-1 btn btn-primary badge text-white'>CITAR</a>
							<a href='index.php?controller=vistas&action=editarTema&idp=".$_GET['idp']."&idt=".$_GET['idt']."&idst=".$_GET['idst']."' class='col-1 btn btn-warning badge text-dark'>EDITAR</a>";
						if($del == 0){echo "<a href='index.php?controller=post&action=borrarPost&idp=".$_GET['idp']."' class='col-1 btn btn-danger badge text-white'>ELIMINAR</a>";}
						else{echo "<a class='col-1 btn btn-secondary badge text-dark'>ELIMINAR</a>";}
					}
					elseif($cerrado == 0){
						echo "<a class='col-1 btn btn-primary badge text-white'>CITAR</a>
						<a class='col-1 btn btn-secondary badge text-dark'>EDITAR</a>
						<a class='col-1 btn btn-secondary badge text-dark'>ELIMINAR</a>";}
					elseif($cerrado == 1){
						echo "<span class='col-3 btn table-dark badge text-warning'>Tema cerrado</span>";}
					echo "
                </div>
                <div class='RLB col-2 pb-3 bg-warning text-center'>
                    <img class='mx-auto mb-2 rounded avatar' src='images/avatares/".$avatar."'/>
                    <span>MENSAJES:</span>
					<div class='m-auto mb-2 rounded informacion'>".$total_men."</div><br>
                    <span>REGISTRO:</span>
					<div class='m-auto mb-2 rounded informacion'>".date('d/m/Y', strtotime($registroC))."</div><br>
                    <!-- <div class='d-inline-block m-auto mb-2 text-center myweb'><a href='http://www.mcc-videos.blogspot.com'>WEB</a></div> -->
                    <!-- <div class='d-inline-block m-auto mb-2 text-center mensajeprivado'><a href='#'>MP</a></div> -->
                </div>
                <div class='RRB col-10 row p-2 pb-3 bg-light mx-auto'>
                    <div class='col-12 mt-2 mb-2 p-3 mb-0 border rounded bg-white'>".nl2br($post['mensaje'])."</div>";
                    if(!empty($firmaC)){ echo"<p class='col-12 p-1 border my-auto rounded bg-white text-center'>".$firmaC."</p>";} 
                    echo "</div></div>";
            
                    // Se repite el proceso de antes pero esta vez para cada usuario que ha respondido al post.
            for($m = 0; $m < count($mensajes); $m++){$total_men = 0;
	            if($_GET['idp'] == $mensajes[$m]['post']){
	            	for ($u = 0; $u < count($usuarios); $u++){
	            		if($mensajes[$m]['usuario'] == $usuarios[$u]['id']) {$usuarioR = $usuarios[$u]['nombre']; $registroR = $usuarios[$u]['registro']; $nivelR = $usuarios[$u]['nivel'];
			            	for($i = 0; $i < count($preferencias); $i++){
			            		if($preferencias[$i]['usuario'] == $usuarios[$u]['id']) {$avatar = $preferencias[$i]['avatar']; $firma = $preferencias[$i]['firma'];}
			            	}
			            	for($j = 0; $j < count($MSG); $j++){
			            		if($MSG[$j]['usuario'] == $usuarios[$u]['id']){$total_men++;}
			            	}
		            	}
		            } 
		       
		            
		            echo "
					<div class='col-12 row p-0 pb-2 b-transluced mx-auto'>
		                <div class='RLT pt-1 col-2 pb-2 bg-warning text-center'>
		                    <h5 class='m-auto usuario rounded "; 
					            if ($nivelR == 0) { echo "u-ban' data-toggle='tooltip' data-placement='bottom' title='BANEADO' "; }
					            elseif($nivelR == 1) { echo "u-bot' data-toggle='tooltip' data-placement='bottom' title='BOT'"; }
					            elseif($nivelR == 100) { echo "u-cola' data-toggle='tooltip' data-placement='bottom' title='Colaborador'"; }
					            elseif($nivelR == 101) { echo "u-mod' data-toggle='tooltip' data-placement='bottom' title='Moderador'"; }
					            elseif($nivelR == 110) { echo "u-admin' data-toggle='tooltip' data-placement='bottom' title='Administrador'"; }
					            elseif($nivelR == 111) { echo "u-master' data-toggle='tooltip' data-placement='bottom' title='Web-Master'"; }
					            elseif($nivelR == 200) { echo "u-del' data-toggle='tooltip' data-placement='bottom' title='Cuenta eliminada'"; }
					            else{ echo "' data-toggle='tooltip' data-placement='bottom' title='Usuario'";}
		            		echo ">".$usuarioR."</h5>
		                </div>
		                <div id=".$mensajes[$m]['id']." class='RRT col-10 row p-2 pb-2 bg-light mx-auto'>
		                    <span class='table-secondary-custom rounded col-9'>Respondido el "; echo date('d/m/Y H:i:s', strtotime($mensajes[$m]['creacion'])); if(is_null($mensajes[$m]['modificado'])){} else{ echo " - Editado el ".date('d/m/Y H:i:s', strtotime($mensajes[$m]['modificado']));} echo "</span>";
		            		if(isset($_SESSION['uid']) && $_SESSION['uid'] == $mensajes[$m]['usuario'] && $mensajes[$m]['borrado'] == 0 && $cerrado == 0 || intval($nivel['nivel']) >= 101 && intval($nivel['nivel']) < 200 && $mensajes[$m]['borrado'] == 0){
								echo "<a class='col-1 btn btn-primary badge text-white'>CITAR</a><a href='index.php?controller=vistas&action=editar&idp=".$_GET['idp']."&mid=".$mensajes[$m]['id']."' class='col-1 btn btn-warning badge text-dark'>EDITAR</a>
								<a href='index.php?controller=post&action=borrarMensaje&idp=".$_GET['idp']."&mid=".$mensajes[$m]['id']."' class='col-1 btn btn-danger badge text-white'>ELIMINAR</a>";}
								elseif(isset($_SESSION['uid']) && $_SESSION['uid'] == $mensajes[$m]['usuario'] && $mensajes[$m]['borrado'] == 1  && $cerrado == 0 || intval($nivel['nivel']) >= 101 && intval($nivel['nivel']) < 200 && $mensajes[$m]['borrado'] == 1){
								echo "<span class='col-3 btn table-dark badge text-warning'>Mensaje borrado</span>";}
							elseif($mensajes[$m]['borrado'] == 1  && $cerrado == 0){
								echo "<span class='col-3 btn btn-dark badge text-warning'>Mensaje borrado</span>";}
							elseif($mensajes[$m]['borrado'] == 0  && $cerrado == 0){
								echo "<a class='col-1 btn btn-primary badge text-white'>CITAR</a>
								<a class='col-1 btn btn-secondary badge text-dark'>EDITAR</a>
								<a class='col-1 btn btn-secondary badge text-dark'>ELIMINAR</a>";}
							elseif($cerrado == 1){
								echo "<span class='col-3 btn table-dark badge text-warning'>Tema cerrado</span>";}
							echo "
		                </div>
		                <div class='RLB col-2 pb-3 bg-warning text-center'>
							<img class='mx-auto mb-2 rounded avatar' src='images/avatares/".$avatar."'/>
		                    <span>MENSAJES:</span>
							<div class='m-auto mb-2 rounded informacion'>".$total_men."</div><br>
		                    <span>REGISTRO:</span>
							<div class='m-auto mb-2 rounded informacion'>".date('d/m/Y', strtotime($registroR))."</div><br>
		                    <!-- <div class='d-inline-block m-auto mb-2 text-center mensajeprivado'><a href='#'>MP</a></div> -->
		                </div>
		                <div class='RRB col-10 row p-2 pb-3 bg-light mx-auto'>
		                    <div class='col-12 mt-2 p-3 mb-0 border rounded bg-white'>".nl2br($mensajes[$m]['mensaje'])."</div>";
		                if(!empty($firma)){ echo"<p class='col-12 p-1 border my-auto rounded bg-white text-center'>".$firma."</p>";} 
                    echo "</div></div>";
	            }
            }
         ?>
         
            <div class='col-6 p-0 b-transluced m-auto text-left'><?php // Páginación desactivada ya que no está programada. ?>
                <!-- <a class='btn nounderline border bg-white' data-toggle='tooltip' title='Ir a la primera página' href='#'>|<<</a>
                <a class='btn nounderline border bg-white' data-toggle='tooltip' title='Ir a la página anterior' href='#'><</a>
                <span class='btn nounderline border bg-primary text-white' data-toggle='tooltip' title='Página actual' >1</span>
                <a class='btn nounderline border bg-white' data-toggle='tooltip' title='Ir a la página NUM' href='#'>2</a>
                <a class='btn nounderline border bg-white' data-toggle='tooltip' title='Ir a la página siguiente' href='#'>></a>
                <a class='btn nounderline border bg-white' data-toggle='tooltip' title='Ir a la última página' href='#'>>>|</a> -->
            </div>
            <div class='col-6 p-0 b-transluced m-auto text-right'>
                <a href="index.php?controller=vistas&action=subindice&idt=<?php echo $_SESSION['idt']."&idst=".$_SESSION['idst']; ?>" class="col-3 text-dark btn btn-warning">VOLVER A INDICE</a>
                <?php 
                if($cerrado == '0'){
                	if(isset($_SESSION['uid']) && intval($nivel['nivel']) >= 110 && intval($nivel['nivel']) < 200){echo "<a href='index.php?controller=post&action=cerrarTema&idp=".$_GET['idp']."'class='col-3 text-white btn btn-danger'>CERRAR</a>";} 
                	if(isset($_SESSION['uid'])){echo " <a href='index.php?controller=vistas&action=responder&idp=".$_GET['idp']."'class='col-3 text-white btn btn-primary'>RESPONDER</a>";} 
                	else{echo " <a href='index.php?controller=vistas&action=pantalla_login' class='col-3 text-white btn btn-primary'>RESPONDER</a>";} 
                } else {echo "<span class='col-3 text-white btn btn-dark'>CERRADO</span>";}
                ?>
            </div>
        </main>   
        <?php include "footer.php"; ?>
    </body>
</html>