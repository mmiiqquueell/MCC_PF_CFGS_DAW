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
            <h2 class="bg-warning-custom rounded">Inicio de sesión</h2>
            <form class="pb-5" action="index.php?controller=usuario&action=login" method="post">
                <label>Usuario</label><br>
                <input type="text" name="usuario" required /><br><br>
                <label>Contraseña</label><br>
                <input type="password" name="password" required /><br><br>
                <input class="btn btn-primary text-white" type="submit" name="submit" value="iniciar sesión" />
            </form>
            
            <p class="table-secondary-custom-2 rounded mt-3 text-white">¿No tiene cuenta? Pulse <a class="btn btn-warning text-dark badge" href="index.php?controller=vistas&action=registrar">aquí</a> para crear una cuenta de nueva.</p>
            <p class="table-secondary-custom-2 rounded mt-3 text-white">¿Ha olvidado su contraseña? Pulse <a class="btn btn-light text-dark badge" href="#">aquí</a> para restablecer su contraseña.</p>
            <p class="table-secondary-custom-2 rounded mt-3 text-white">¿No ha recivido el mail de activación? Pulse <a class="btn btn-success text-light badge" href="index.php?controller=vistas&action=reenviar">aquí</a> para reenviar un mail de activación.</p>
           	<p id="aviso2" class="alert alert-danger" role="alert">
				<?php // Código PHP que muestra diferentes errores según valor devuelto por controlador a la base de datos //
					if (isset($_GET['error1'])) {
						echo "<script>mostrar1();</script>"."Aun no has verificado tu cuenta. Pulse <a class='btn btn-primary text-white' href='#'>aquí</a> para reenviar el mail de activación.";
					} elseif (isset($_GET['error2'])) {
						echo "<script>mostrar1();</script>"."Lo sentimos, su cuenta ha sido baneada de forma permanente, si se trata de un error utilice el <a class='btn btn-dark text-white' href='#'>formulario de contacto</a>";
					} elseif (isset($_GET['error3'])) {
						echo "<script>mostrar1();</script>"."La cuenta a la que intenta acceder ha sido marcada como BOT y bloqueada.";
					}elseif (isset($_GET['error4'])) {
						echo "<script>mostrar1();</script>"."El usuario y/o contraseña no son correctos, por favor, verifique que ha escrito correctamente el nombre u contraseña.";
					}
				?>
			</p>
        </main>
        
        <?php include "footer.php"; ?>
    
    
    </body>
</html>