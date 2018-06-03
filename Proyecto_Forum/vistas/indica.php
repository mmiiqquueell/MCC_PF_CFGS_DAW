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
                    <span>SECCIONES</span>
                </div>
                <div class='col-1 border bg-white'>
                    <span>TEMAS</span>
                </div>
                <div class='col-1 border bg-white'>
                    <span>MSG</span>
                </div>
                <div class='rounded-right col-3 border bg-white'>
                    <span>ÚLTIMO MENSAJE</span>
                </div>
            </div>
            <?php 
            $post = 0; $totalmsg = 0; $nombre_post; $creador_post; $fecha_post;
            foreach ($tema as $tema){
      			echo "<div class='col-12 row p-0 pb-2 pt-3 b-transluced pl-lg-0 mx-auto'>
						<div class='col-12 rounded bg-warning-custom'>
							<h3 class='font-weight-bold text-dark'>".$tema['nombre']."</h3>
						</div>
		            </div>"; 
		            }
		 
		        for ($i = 0; $i < count($subtemas); $i++){$fecha_post = "2000-01-01 00:00:00";
		            if($tema['id'] == $subtemas[$i]['padre']){
		            	for($p = 0; $p < count($contapost); $p++){
		            		if($subtemas[$i]['id'] == $contapost[$p]['subtema']){
		            			if($contapost[$p]['ultima_fecha'] > $fecha_post){
		            				$fecha_post = $contapost[$p]['ultima_fecha']; $nombre_post = $contapost[$p]['titulo'];
		            				for($u = 0; $u < count($usuarios); $u++){
		            					if($usuarios[$u]['id'] == $contapost[$p]['creador']) {
		            						$creador_post = $usuarios[$u]['nombre'];
		            					}
		            				}
		            			}
		            			$post++;
		            			for($m = 0; $m < count($MSGT); $m++){
		            				if($subtemas[$i]['id'] == $contapost[$p]['subtema'] && $contapost[$p]['id'] == $MSGT[$m]['post']){$totalmsg++;}
		            				if($subtemas[$i]['id'] == $contapost[$p]['subtema'] && $contapost[$p]['id'] == $MSGT[$m]['post'] && $MSGT[$m]['creacion'] > $fecha_post){
		            					$fecha_post = $MSGT[$m]['creacion'];
		            					for($u2 = 0; $u2 < count($usuarios); $u2++){
		            						if($usuarios[$u2]['id'] == $MSGT[$m]['usuario']) {
		            							$creador_post = $usuarios[$u2]['nombre'];
		            						}
		            					}
		            				}
		            			}
		            		}
		            	}
		            echo "<div class='col-12 row b-transluced p-0 pl-lg-0 pb-1 mx-auto'>
		            	<a href='index.php?controller=vistas&action=subindice&idst=".$subtemas[$i]['id']."&idt=".$tema['id']."' class='rounded-left col-6 border bg-white pb-2'>
				            <span>".$subtemas[$i]['categoria']."</span><br>
				            <span>".$subtemas[$i]['descripcion']."</span>
		            	</a>
		            	<div class='col-1 border bg-white text-center'>
			            	<h2 class=''>".$post."</h2>
			            </div>
			            <div class='col-1 border bg-white text-center'>
			            	<h2>".$totalmsg."</h2>
			            </div>
				        <div class='rounded-right col-4 border bg-white pb-2'>
				            <span>".$nombre_post."</span><br>
				            <span>Por ".$creador_post." el ".date('d/m/Y H:i:s', strtotime($fecha_post))."</span>
			            </div>
		            </div>";} $post = 0; $totalmsg = 0;
				};
           ?>
        </main>   
    
        <?php include "footer.php"; ?>
        
    </body>
</html>