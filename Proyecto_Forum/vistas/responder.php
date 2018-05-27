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
			$("#mensaje").YellowText();
            encendido.onclick = filtra; // Asigna una función al botón indicado //
            function filtra() { // La función activa o desactiva el efecto CRT (pantalla antigua) //
                if (activo) {filtro.style.transition = "1s"; filtro.style.opacity = "0"; activo = false;}
                else {filtro.style.transition = "1s"; filtro.style.opacity = "0.2"; activo = true;}
            }	
		}
	</script>

    <body class="container">
    <div id="filtro" class="filtro"></div>
        <?php include "header.php"; ?>
        <main class="mt-3 col-12 row b-transluced text-dark p-0 text-left">
            <div class='rounded mb-2 col-12 bg-warning-custom'>
                    <h3 class="font-weight-bold"><?php echo $post['titulo']; ?> > RESPONDER</h3>
                </div>
            <form class='col-12 row p-0 pb-2 b-transluced mx-auto' action="index.php?controller=post&action=comentar&idp=<?php echo $_GET['idp']; ?> " method="post">
                <div class="RLT col-2 pb-0 bg-warning text-center">
                    
                </div>
                <div class="RRT col-10 row p-2 pb-2 bg-light mx-auto">
                    <p class="col-12 mt-1 mb-2 p-1 mb-0 border rounded bg-white"><?php echo $post['titulo']; ?></p>
                </div>
                <div class="RLB col-2 m-0 pb-3 h-100 bg-warning text-center">
                   
                </div>
                <div class="RRB col-10 row p-2 pb-3 bg-light mx-auto">
                    <textarea id="mensaje" name="mensaje" class="col-12 mt-2 mb-2 p-3 mb-0 border rounded bg-white" placeholder="Mensaje del tema"></textarea>
                </div>
                <div class='col-12 p-0 b-transluced mt-2 text-right'>
                   <!-- <a type="submit" class="col-3 text-white btn btn-info">VER MENSAJES</a>
                    <a type="submit" class="col-3 text-dark btn btn-warning">VISTA PREVIA</a> -->
                    <input type="submit" class="col-3 text-white btn btn-primary" value="RESPONDER">
                </div>
            </form>
                        
            
        </main>
        
        <?php include "footer.php"; ?>
    
    </body>
</html>