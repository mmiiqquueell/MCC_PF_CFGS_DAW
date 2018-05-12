<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Retro Gaming Forum</title>
        <?php include "bootstrap.php"; ?>
    </head>
    <script>	
		// CÓDIGO RECICLADO DEL ANTERIOR PROYECTO //
		// Este código no puede ejecutarse externamente por llamadas a Bootstrap desde PHP //
		
        var comprobar; // Se genera una variable vacía para que PHP pueda llamarla //
		function mostrar1() { // Función que muestra los errores por medio de Bootstrap creados por PHP//
			setTimeout(function(){$("#aviso2").show()},100); // Se efectúa un retraso en la ejecución para darle tiempo a que se genere el HTML //
			setTimeout(function(){$("#aviso2").hide();},3600000); // A la hora desaparece el mensaje de error //
		}	
		window.onload = function() { // Función que se ejecuta al cargar el HTML //
			$("#aviso2").hide();
			
			var filtro = document.getElementById('filtro'), encendido = document.getElementById('CRT'), activo = true; // Almacena DIV en variables ademas de guardar un boolean //

            encendido.onclick = filtra; // Asigna una función al botón indicado //
            function filtra() { // La función activa o desactiva el efecto CRT (pantalla antigua) //
                if (activo) {filtro.style.transition = "1s"; filtro.style.opacity = "0"; activo = false;}
                else {filtro.style.transition = "1s"; filtro.style.opacity = "0.2"; activo = true;}
            }		
            	     
		}
            
    </script>
    <body class="container">
        <?php include "header.php"; ?>
        <div id="filtro" class="filtro"></div>
        <main class="p-2 text-center text-white">
            <h2 class="bg-warning-custom rounded">Activación de cuenta</h2>
           	<p id="aviso2" class="alert alert-warning" role="alert">
				<?php // Código PHP que muestra diferentes errores según valor devuelto por controlador a la base de datos //
					if (isset($_GET['act1'])) {
						echo "<script>mostrar1();</script>"."Su cuenta ha sido activada correctamente.";
					} elseif (isset($_GET['act2'])) {
						echo "<script>mostrar1();</script>"."Su cuenta ya está activada.";
					} elseif (isset($_GET['act3'])) {
						echo "<script>mostrar1();</script>"."La cuenta que intenta activar ha sido bloqueada o baneada.";
					}
				?>
			</p>
        </main>
        
        <?php include "footer.php"; ?>
    
    
    </body>
</html>