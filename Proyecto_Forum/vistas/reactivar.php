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
			setTimeout(function(){$("#aviso2").hide();},30000); // A los 5 segundos desaparece el mensaje de error //
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
            <h2 class="bg-warning-custom rounded">E-mail de activación</h2>
            <form class="pb-5" action="index.php?controller=usuario&action=resendmail" method="post">
                <label>Introduzca su dirección de correo para que podamos enviarle el email de activación.</label><br>
                <input type="text" name="mail" /><br><br>
                <input class="btn btn-primary text-white" type="submit" name="submit" value="Enviar email" />
            </form>
            <p id="aviso2" class="alert alert-danger" role="alert">
				<?php // Código PHP que muestra diferentes errores según valor devuelto por controlador a la base de datos //
					if (isset($_GET['error1'])) {
						echo "<script>mostrar1();</script>"."Por favor, verifique que ha escrito correctamente la dirección de email.";
					} elseif (isset($_GET['error2'])) {
						echo "<script>mostrar1();</script>"."La cuenta ya está activada, no es necesario volver a reactivarla.";
					}  elseif (isset($_GET['info1'])) {
						echo "<script>mostrar1();</script>"."Se ha mandado un email de reactivación, por favor, verifique su correo.";
					} 
				?>
			</p>
        <?php include "footer.php"; ?>
    </body>
</html>