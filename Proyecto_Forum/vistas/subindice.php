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
        <main class="mt-3 col-12 b-transluced text-dark p-0 text-left">
            <div class='col-12 row p-0 pb-3 b-transluced text-center mx-auto'>
                <div class='rounded-left col-7 border bg-white pb-1'>
                    <span>TEMAS</span>
                </div>
                <div class='col-2 border bg-white'>
                    <span>RESPUESTAS</span>
                </div>
                <div class='rounded-right col-3 border bg-white'>
                    <span>ÚLTIMO MENSAJE</span>
                </div>
            </div>
            
            
            <?php 
            $men = 0; $idst = $_GET['idst']; $idt = $_GET['idt'];
            foreach ($tema as $tema){
            	echo "
					<div class='col-12 row p-0 pb-2 b-transluced pl-lg-0 mx-auto'>
		            	<div class='col-10 rounded-left bg-warning-custom-1 mr-0 pr-0'>
		            		<h3 class='font-weight-bold'><a href='index.php?controller=vistas&action=indica&id=".$tema['id']."'>".$tema['nombre']."</a> > ".$subtema['categoria']."</h3>
		            	</div>
		            	<div class='col-2 row bg-warning-custom-2 ml-0 pl-0'>
		            		<a "; if(isset($_SESSION['user'])){echo "href='index.php?controller=vistas&action=nuevoTema&idst=".$_GET['idst']."&idt=".$_GET['idt']."'";} else{echo "href='index.php?controller=vistas&action=pantalla_login'";} echo "class='rounded-right col-12 text-dark btn btn-warning border rounded m-auto p-0 pb-1'>NUEVO TEMA</a>
	            		</div>
					</div>";	
            };
            
            foreach($post as $cuestiones) { 
            	for($n = 0; $n < count($usuarios); $n++){ // Muestra el nombre del creador de POST debajo del titulo
            		if($cuestiones['creador'] == $usuarios[$n]['id']){$creador = $usuarios[$n]['nombre'];}
            	}
            	for($us = 0; $us < count($usuarios); $us++){ // Muestra el nombre y fecha del creador del post en el lado de ÚLTIMO MENSAJE si el tema no tiene mensajes.
            		$idp = $cuestiones['id']; $fecha = $cuestiones['fecha_creacion'];
            		if($cuestiones['creador'] == $usuarios[$us]['id']) {
            			$escritor = $usuarios[$us]['nombre'];
            		}
            	}
            	
            	for($i = 0; $i < count($MSG); $i++){ // Muestra la cantidad de mensajes totales de cada post
            		if($cuestiones['id'] == $MSG[$i]['post']){$men++;}    
            	}
            	$fecha = '0000-00-00 00:00:00'; // Reset de la fecha
            	for($i = 0; $i < count($MSG); $i++){ // Muestra el creador y fecha del último comentario si hay mensajes en el tema.
            		for($u = 0; $u < count($usuarios); $u++){
            			if($cuestiones['id'] == $MSG[$i]['post']){
            				if($MSG[$i]['creacion'] > $fecha && $MSG[$i]['usuario'] == $usuarios[$u]['id']){
	            				$fecha = $MSG[$i]['creacion']; 
	            				$escritor = $usuarios[$u]['nombre'];
	            				$idp = $cuestiones['id'];
            				}
            			} 
            			elseif($cuestiones['id'] != $MSG[$i]['post'] || $cuestiones['id']){ // Muestra los POST que no tienen respuestas ya que de lo contrario aparecen los post en la lista pero la ID no se corresponde con el mensaje.
            				$idp = $cuestiones['id']; $fecha = $cuestiones['fecha_creacion'];
            				if($cuestiones['creador'] == $usuarios[$u]['nombre']) {
            					$escritor = $usuarios[$u]['nombre'];
            				}
            			}
            		}
            	}
            	// Se dibuja la lista de mensajes.
            	echo "
				<div class='col-12 row b-transluced p-0 pl-lg-0 pb-1 mx-auto'>
	                <a href='index.php?controller=vistas&action=tema&idp=".$idp."&idt=".$idt."&idst=".$idst."' class='rounded-left col-7 border bg-white pb-0'>
	                    <span class='mb-0 text-bold'>".$cuestiones['titulo']."</span><br>
						<span>Por ".$creador."</span>
	                </a>
	                <div class='col-2 border bg-white text-center'>
	                    <h2 class='p-0'>".$men."</h2>
	                </div>
	                <div class='rounded-right col-3 border bg-white p-0 p-1'>
	                    <span>Por ".$escritor."<br>El ".date('d/m/Y H:i:s', strtotime($fecha))."</span>
	                </div>
	            </div>"; $men = 0;
            }
            
            
            ?>
        </main>   
    
        <?php include "footer.php"; ?>
        
    </body>
</html>