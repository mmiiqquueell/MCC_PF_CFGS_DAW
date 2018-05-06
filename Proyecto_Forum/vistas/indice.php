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
            $a = null; $post = 0; $totalmsg = 0;
            foreach ($temas as $temas){
            	if ($a != $temas['nombre']){
		            echo "<div class='col-12 row p-0 pb-2 pt-3 b-transluced pl-lg-0 mx-auto'>
		                <div class='col-12 rounded bg-warning-custom'>
		                    <a href='index.php?controller=vistas&action=indica&id=".$temas['id']."'><h3 class='font-weight-bold text-dark'>".$temas['nombre']."</h3></a>
		                </div>
		            </div>";
		            $a = $temas['nombre']; }
		 
		 		for ($i = 0; $i < count($subtemas); $i++ ){
					if($temas['id'] == $subtemas[$i]['padre']){
						for($p = 0; $p < count($contapost); $p++){
							if($subtemas[$i]['id'] == $contapost[$p]['subtema']){$post++;
								for($m = 0; $m < count($MSGT); $m++){
									if($subtemas[$i]['id'] == $contapost[$p]['subtema'] && $contapost[$p]['id'] == $MSGT[$m]['post']){$totalmsg++;}
								}
							}
						}
						 
		            echo "<div class='col-12 row b-transluced p-0 pl-lg-0 pb-1 mx-auto'>
		            	<a href='index.php?controller=vistas&action=subindice&idst=".$subtemas[$i]['id']."&idt=".$temas['id']."' class='rounded-left col-7 border bg-white pb-2'>
				            <span>".$subtemas[$i]['categoria']."</span><br>
				            <span>".$subtemas[$i]['descripcion']."</span>
		            	</a>
		            	<div class='col-1 border bg-white text-center'>
			            	<h2 class=''>".$post."</h2>
			            </div>
			            <div class='col-1 border bg-white text-center'>
			            	<h2>".$totalmsg."</h2>
			            </div>
				        <div class='rounded-right col-3 border bg-white pb-2'>
				            <span>Consola no enciende</span><br>
				            <span>Mike a las 16:35</span>
			            </div>
		            </div>";} $post = 0; $totalmsg = 0;
				}
				
	       };
           ?>
        </main>   
    
        <?php include "footer.php"; ?>
        
    </body>
</html>