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
			setTimeout(function(){$("#aviso2").hide();},5000); // A los 5 segundos desaparece el mensaje de error //
		}
		function mostrar3() { // Función que muestra los info por medio de Bootstrap creados por PHP//
			setTimeout(function(){$("#aviso3").show()},100); // Se efectúa un retraso en la ejecución para darle tiempo a que se genere el HTML //
			setTimeout(function(){$("#aviso3").hide();},5000); // A los 5 segundos desaparece el mensaje de información //
		}
		
		window.onload = function() { // Función que se ejecuta al cargar el HTML //
			
			var filtro = document.getElementById('filtro'), encendido = document.getElementById('CRT'), activo = true; // Almacena DIV en variables ademas de guardar un boolean //

            encendido.onclick = filtra; // Asigna una función al botón indicado //
            function filtra() { // La función activa o desactiva el efecto CRT (pantalla antigua) //
                if (activo) {filtro.style.transition = "1s"; filtro.style.opacity = "0"; activo = false;}
                else {filtro.style.transition = "1s"; filtro.style.opacity = "0.2"; activo = true;}
            }			
                            
			var inputs = document.forms[1].elements, // Obtiene todos los INPUT y los pone en un array //
                num1 = Math.floor((Math.random() * 9) + 0), // Genera un número aleatorio entre 0 y 9 para una variable // No se usa FOR por problemas
                num2 = Math.floor((Math.random() * 9) + 0), // Genera un número aleatorio entre 0 y 9 para una variable // 
				resultado = ['cero', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciseis', 'diecisiete', 'dieciocho'], // Array de números en letras desde el 0 hasta el 18 para la suma de seguridad //
				suma = num1 + num2, // Suma de los dos números aleatorios //
				numeros = "0123456789", min = "abcdefghijklmnopqrstuvwxyz", may = "ABCDEFGHIJKLMNOPQRSTUVWXYZ", espe = "@.-_", // Cuatro arrays que almacenan la posibilidad de contraseña con mayúsculas, minúsculas, números y caracteres especiales (solo validos permitidos para contraseñas aunque vale cualquiera) //
				limites1 = [32, 64, 64, 256, 256], // array que indica el limitador de caracteres en los inputs //
				limites2 = ["nombre de usuario", "contraseña", "repetir contraseña", "email", "repetir email", "politica de privacidad"], // array que indica el nombre de cada objeto //
				coincide = false, // Variable que almacena si la contraseña es igual a la repetición de la misma //
                parrafo = document.getElementsByTagName('p')[2], // Se guarda un parrafo para indicar errores //
				correcto = true, passwd1 = false, passwd2 = false, passwd3 = false, passwd4 = false, passwd5 = false; // Variables que hacen de puerta para verificar si el registro de usuario es correcto //
				
			inputs[6].value = num1; inputs[7].value = num2; // Asigna a los inputs un Captcha básico de seguridad con 2 números generados aleatoriamente //
			$("#aviso1").hide(); $("#aviso2").hide();$("#aviso3").hide(); // Oculta los párrafos de error/info para que no se vean al abrir la web //
			
			comprobar = function() { // Función que comprueba ... /
				
				correcto = true; passwd1 = false; passwd2 = false; passwd3 = false; passwd4 = false; passwd5 = false; // Variables que establecerán la condición en caso de que sea o no valido el formulario //
				
				for (var i = 0; i < inputs.length-1; i++) {inputs[i].style.backgroundColor = "#FFF";} // Si las variables son correctas se devuelve el color blanco a los inputs incorrectos //
				
				for (var i = 0; i < 5; i++) { // Bucle FOR que busca que los inputs no estén vacíos y muestra su respectivo mensaje de error // Contraseña se verifica en dos puntos //
					if(inputs[i].value.length == 0){
						inputs[i].style.backgroundColor = "#F00"; parrafo.innerHTML = "El campo '" + limites2[i] + "' no puede estar vacio."; correcto = false; break;
					}
					else if(inputs[i].value.length > limites1[i]){ // En caso que se cumpla el mínimo de UN carácter se verificara que no superan el limite de caracteres permitidos y muestra un error //
						inputs[i].style.backgroundColor = "#F00"; parrafo.innerHTML = "Se ha superado el limite de caracteres maximo permitidos en '" + limites2[i] + "'."; correcto = false; break;
					}
				}
                
				if (!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(inputs[3].value.toLowerCase()))) { // Verifica que el email sea válido //
					inputs[2].style.backgroundColor = "#F00"; inputs[3].focus(); parrafo.innerHTML = "El campo '" + limites2[3] + "' no es valido."; correcto = false;
				}
				else if (inputs[8].value.toLowerCase() != resultado[suma]) { // Verifica que la suma de seguridad sea válida //
					inputs[8].style.backgroundColor = "#F00"; inputs[8].focus(); 
					parrafo.innerHTML = "La suma no es correcta, comprueba que has escrito correctamente la suma."; correcto = false;
				}
								
				// Se verifica la contraseña (no la repetición). //
				for (var i = 0; i < inputs[1].value.length; i++) {
					if (inputs[1].value.length >= 8) {passwd1 = true;}  // Tiene 8 caracteres? //
					if (numeros.indexOf(inputs[1].value.charAt(i),0) != -1) {passwd2 = true;} // Tiene números? //
					if (min.indexOf(inputs[1].value.charAt(i),0) != -1) {passwd3 = true;} // Tiene minúsculas? //
					if (may.indexOf(inputs[1].value.charAt(i),0) != -1) {passwd4 = true;} // Tiene mayúsculas? //
					if (espe.indexOf(inputs[1].value.charAt(i),0) != -1) {passwd5 = true;} // Tiene caracteres especiales? //
				}
				
				// En función al FOR anterior se ejecutaran las siguientes condiciones //
				if (!passwd1) { correcto = false; // Si no tiene 8 o más caracteres se notificara el error //
					inputs[1].focus(); inputs[1].style.backgroundColor = "#F00";
					parrafo.innerHTML = "La " + limites2[1] + " debe tener al menos 8 caracteres.";
				}
				else if (!passwd2) { correcto = false; // Si no tiene números se notificara //
					inputs[1].focus(); inputs[1].style.backgroundColor = "#F00";
					parrafo.innerHTML = "La " + limites2[1] + " debe tener al menos un número.";
				}
				else if (!passwd3) { correcto = false; // Si no tiene minúsculas //
					inputs[1].focus(); inputs[1].style.backgroundColor = "#F00";
					parrafo.innerHTML = "La " + limites2[1] + " debe tener al menos una minúscula.";
				}
				else if (!passwd4) { correcto = false; // Si no tiene mayúsculas //
					inputs[1].focus(); inputs[1].style.backgroundColor = "#F00";
					parrafo.innerHTML = "La " + limites2[1] + " debe tener al menos una mayúscula.";
				}
				else if (!passwd5) { correcto = false; // Si no tiene caracteres especiales //
					inputs[1].focus(); inputs[1].style.backgroundColor = "#F00";
					parrafo.innerHTML = "La " + limites2[1] + " debe tener al menos un caracter especial ( @ . - _ ).";
				}
				// Si ninguno de los anteriores falla se verificara que la contraseña coincide con la repetición // por eso no es necesario comprobar que la contraseña repetida cumpla las condiciones ya que si no cumple no se comprobara y por tanto indicara el error //
				else if (passwd1 && passwd2 && passwd3 && passwd4 && passwd5 && inputs[1].value != inputs[2].value) {
					inputs[1].focus(); inputs[2].style.backgroundColor = "#F00"; inputs[1].style.backgroundColor = "#F00";
					parrafo.innerHTML = "Las contraseñas no coinciden."; correcto = false;
				} 

				// Se verifica que los mails coincien.
				else if (inputs[3].value != inputs[4].value) {
					inputs[4].focus(); inputs[3].style.backgroundColor = "#F00"; inputs[4].style.backgroundColor = "#F00";
					parrafo.innerHTML = "Los emails no coinciden."; correcto = false;
				}
				
				setTimeout(function(){$("#aviso1").hide();},5000); // Oculta el error de bootstrap a los 5 segundos //
				
				// Si es correcto se enviara el formulario, en caso contrario se mostrara el mensaje de error de Javascript//
				if (correcto) {return true;}
				else{$("#aviso1").show(); return false;}
			}
			
		}
            
    </script>
    
    
    <body class="container">
        <?php include "header.php"; ?>
		<div id="filtro" class="filtro"></div>
        <main class="p-2 text-center text-white">
            <h2 class="bg-warning-custom rounded">Creación de cuenta</h2>
            <form class="pb-5" onsubmit="return comprobar()" action="index.php?controller=usuario&action=crear" method="post">
                <input type="text" name="usuario" placeholder="Nombre de usuario"/><br><br>
                <input type="password" name="password" placeholder="Contraseña"/> 
                <input type="password" name="rpassword" placeholder="Repetir Contraseña"/><br><br>
                <input type="text" name="email" placeholder="email"/> 
                <input type="text" name="remail" placeholder="Repetir email"/><br><br>
                <input type="checkbox" name="politica" /><br><span>Acepto la <a>politica de privacidad</a></span><br><br>
                <label>Escribe el resultado de la suma con letras.</label><br>
				<input class="col-2 col-sm-2 col-md-2 col-lg-1 col-xl-1 centext text-center"  type="text" size="10" disabled /> + 
				<input class="col-2 col-sm-2 col-md-2 col-lg-1 col-xl-1 centext text-center"  type="text" size="10" disabled /> = 
				<input class="col-4 col-sm-5 col-md-4 col-lg-3 col-xl-2 centext text-center"  type="text" size="12" /><br>
				<input type="submit" value="Crear cuenta" class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-2 mt-5 btn btn-success" />
            </form>
            <p id="aviso2" class="alert alert-danger" role="alert">
				<?php // Código PHP que muestra diferentes errores según valor devuelto por controlador a la base de datos //
					if (isset($_GET['error1'])) {
						echo "<script>mostrar1();</script>"."La contraseña debe tener al menos 8 caracteres.";
					} elseif (isset($_GET['error2'])) {
						echo "<script>mostrar1();</script>"."La contraseña debe tener al menos una minúscula.";
					} elseif (isset($_GET['error3'])) {
						echo "<script>mostrar1();</script>"."La contraseña debe tener al menos una mayúscula.";
					}elseif (isset($_GET['error4'])) {
						echo "<script>mostrar1();</script>"."La contraseña debe tener al menos un número.";
					}elseif (isset($_GET['error5'])) {
						echo "<script>mostrar1();</script>"."La contraseña debe tener al menos un caracter especial ( @ . - _ ).";
					}elseif (isset($_GET['error6'])) {
						echo "<script>mostrar1();</script>"."Las contraseñas no coinciden.";
					}elseif (isset($_GET['error7'])) {
						echo "<script>mostrar1();</script>"."Las emails no coinciden.";
					}elseif (isset($_GET['error8'])) {
						echo "<script>mostrar1();</script>"."El nombre introducido ya está en uso, por favor, utilice otro nombre.";
					}elseif (isset($_GET['error9'])) {
						echo "<script>mostrar1();</script>"."Ya existe una cuenta de usuario con esa dirección de email.";
					}elseif (isset($_GET['error10'])) {
						echo "<script>mostrar1();</script>"."Se ha producido un error al intentar crear su usuario, por favor, intentelo más tarde.";
					}
				?>
			</p>
			<p id="aviso3" class="alert alert-info" role="alert">
				<?php // Código PHP que muestra diferentes informaciones según valor devuelto por controlador a la base de datos //
				
				if (isset($_GET['info1'])) {
						echo "<script>mostrar3();</script>"."Su cuenta ha sido creada correctamente, por favor, compruebe su correo para activar su cuenta de usuario.";
					}
				?>
			</p>
			<p id="aviso1" class="alert alert-danger" role="alert"></p>
        </main>
        <?php include "footer.php"; ?>
    </body>
</html>