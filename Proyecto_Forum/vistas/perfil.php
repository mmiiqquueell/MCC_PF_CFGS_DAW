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
			$("#firma").YellowText();
            encendido.onclick = filtra; // Asigna una función al botón indicado //
            function filtra() { // La función activa o desactiva el efecto CRT (pantalla antigua) //
                if (activo) {filtro.style.transition = "1s"; filtro.style.opacity = "0"; activo = false;}
                else {filtro.style.transition = "1s"; filtro.style.opacity = "0.2"; activo = true;}
            }	
		}

		function remove_pill(){
			$('.borrame').removeAttr("data-toggle");
		}
	</script>
    <body class="container">
    <div id="filtro" class="filtro"></div>
       <?php include "header.php"; ?>
			<div class="col-12">
				<ul class="col-12 nav nav-pills nav-justified mt-4">
					<li class="col-3 nav-item">
						<a class="borrame nav-link active border rounded pt-1" data-toggle="pill" href="#general">Información</a>
					</li>
					<li class="col-3 nav-item">
						<a class="borrame nav-link border rounded pt-1" data-toggle="pill" href="#config">Ajustes</a>
					</li>
                    <li class="col-3 nav-item">
						<a class="borrame nav-link border bg-danger rounded pt-1" data-toggle="pill" href="#contact">Contacto</a>
					</li>
					<li class="col-3 nav-item">
						<a class="borrame nav-link border bg-danger rounded pt-1" data-toggle="pill" href="#collection">Colecciones</a>
					</li>
				</ul>
			</div>
			<div class="col-12 text-center">
				<div class="tab-content text-white">
					<div class="table-dark p-2 active rounded tab-pane container row m-0 mt-5" id="general">
						<h1 class="col-12 bg-warning-custom rounded text-dark text-left pl-2 pb-1">Información general</h1>
						<div class='col-2 m-0 d-inline-block align-top mt-5 mb-5'>
							<img src='images/avatares/<?php echo $preferencias['avatar'];?>' class='rounded border avatar'>
						</div>
						<div class='col-4 m-0 d-inline-block m-auto'>
							<span>Actividad</span>
							<?php 
								$m=0; $mt=0; $nombre; $registro; $mail; $sexo; $edad; $pagina; $biografia; $nintendo; $psn; $steam; $xlive; $firma;
								for($i = 0 ; $i < count($MSG); $i++) {$mt++;
									if($_SESSION['uid'] == $MSG[$i]['usuario']){$m++;} 
									for($u = 0 ; $u < count($usuario); $u++) {
										if($_SESSION['uid'] == $usuario[$u]['id']) {
											$nombre = $usuario[$u]['nombre']; $registro = $usuario[$u]['registro']; $mail = $usuario[$u]['mail'];
											$sexo = $preferencias['sexo']; $edad = $preferencias['edad'];
											$pagina = $preferencias['paginaweb']; $biografia = $preferencias['biografia']; 
											$nintendo = $preferencias['nintendo']; $psn = $preferencias['playstation']; 
											$steam = $preferencias['steam']; $xlive = $preferencias['xboxlive']; $firma = $preferencias['firma'];
											$tema = $preferencias['tema']; $hora = $preferencias['zonahoraria']; $fecha = $preferencias['estilofecha'];
											$mensajes = $preferencias['mensajes']; $orden = $preferencias['ordenmensajes'];
										}
									}
								} 
								$total = round((100/$mt)*$m,2);
								echo "
								<div class='w-100 pb-4 mb-3 mt-2 border rounded table-info text-center position-relative'>
									<div class=' p-2 mt-1 m-0 bg-primary position-absolute' style='width:".$total."%'></div>
									<div class='w-100 m-0 rounded text-dark position-absolute'>(".$m.") ".$total."%</div>
								</div>
								<p class='bg-dark text-left pb-1 pl-2 rounded border'>Nombre: ".$nombre." </p>
								<p class='bg-dark text-left pb-1 pl-2 rounded border'>Registro: ".date('d/m/Y', strtotime($registro))."</p>
								<p class='bg-dark text-left pb-1 pl-2 rounded border'>E-mail: ".$mail." </p>
								<p class='bg-dark text-left pb-1 pl-2 rounded border'>Sexo: ".$sexo."</p>
								<p class='bg-dark text-left pb-1 pl-2 rounded border'>Edad: ".floor((time() - strtotime($edad)) / 31556926)." </p>
							
						</div>
						<div class='col-5 m-0 d-inline-block m-auto'>
							<p class='bg-dark text-left pb-1 pl-2 rounded border'>Página: <a href='".$pagina."'>".$pagina."</a></p>
							<p class='bg-dark text-left pb-1 pl-2 rounded border'>Biografia: ".$biografia."</p>
							<p class='bg-light text-dark text-left pb-1 pl-2 rounded border'>Nintendo FC/ID: ".$nintendo."</p>
							<p class='bg-dark-custom-2 text-primary text-left pb-1 pl-2 rounded border'>PlayStation ID: ".$psn."</p>
							<p class='bg-dark-custom-2 text-left pb-1 pl-2 rounded border'>Steam ID: ".$steam."</p>
							<p class='bg-success text-left pb-1 pl-2 rounded border'>XLive ID: ".$xlive."</p>
						</div>
						<div class='col-12 m-0 d-inline-block bg-white text-dark m-auto text-center'> ".$firma."</div>
						";
						?>
						
					</div>
					
					<div class="table-dark p-2 rounded tab-pane mt-5" id="config">
						<h1 class="bg-warning-custom rounded text-dark text-left pl-2 pb-1">Ajustes de usuario</h1>
						<!-- ------------------------------------------------------------------------------ -->
						<div class="col-2 m-0 p-0 d-inline-block align-middle">
							<ul class="col-12 p-0 nav nav-pills nav-justified">
								<li class="col-12 p-0 mb-2 border rounded nav-item bg-dark-custom-2">
									<a class="nav-link active pt-1" data-toggle="pill" href="#avatar">Avatar / Firma</a>
								</li>
								<li class="col-12 p-0 mb-2 border rounded nav-item bg-dark-custom-2">
									<a class="nav-link pt-1" data-toggle="pill" href="#info">Información Personal</a>
								</li>
								<li class="col-12 p-0 mb-2 border rounded nav-item bg-danger">
									<a class="nav-link pt-1" data-toggle="pill" href="#passwd">Cambiar contraseña</a>
								</li>
			                    <li class="col-12 p-0 mb-2 border rounded nav-item bg-dark-custom-2">
									<a class="nav-link pt-1" data-toggle="pill" href="#configurar">Configuración del foro</a>
								</li>
							</ul>
						</div>
						<div class="col-9 m-0 p-0 pl-2 d-inline-block align-top text-center border border-right-0 border-top-0 border-bottom-0">
							<form class="" onsubmit="remove_pill()" action="index.php?controller=usuario&action=guardarConfig" method="post" enctype="multipart/form-data">
								<div class="tab-content text-white">
									<div class="table-dark p-0 rounded tab-pane active container" id="avatar">
										<h1 class="bg-warning-custom rounded text-dark text-left pl-2 pb-1">AVATAR</h1>
										<p>Elija un avatar personalizado: máximo 150x150 y un peso menor a 15 KB.<br>Deberas limpiar la cache para que se actualize el avatar.</p>
										<p>Avatar actual</p>
										<img src='images/avatares/<?php echo $preferencias['avatar'];?>' class='rounded border avatar mb-3'>
										<input class="col-12 btn bg-secondary pb-0" type="file" accept="image/jpeg" name="IMG1">
										<h1 class="bg-warning-custom rounded text-dark text-left pl-2 pb-1 mt-4">FIRMA</h1>
										<p>Escriba su firma personalizado: Máximo de 500 caracteres.</p>
										<div class="col-12 row m-0 p-1 mx-auto border text-dark rounded bg-white">
											<textarea id="firma" name="firma" maxlength="500" class="col-12 mt-2 mb-2 p-3 mb-0 bg-white text-dark"><?php echo $firma; ?></textarea>
										</div>
									</div>
									<div class="tab-pane container text-left mt-5" id="info">
										<h1 class="">INFORMACION PERSONAL (opcional)</h1>
										<label>Biografia: Cuenta algo sobre ti </label><br><input type="text" name="bio" class="w-100" value="<?php echo $biografia; ?>" ><br>
										<label class="mt-2">Edad: Fecha de nacimiento </label><br><input class="w-100" name="edad" value="<?php echo $edad; ?>" type="date"><br>
										<label class="mt-2">Sexo </label><br>
										<select name="sexo" class="w-100">
											<option value="No mostrar" <?php if($sexo == "No mostrar") { echo "selected";} ?>>No mostrar</option>
											<option value="Hombre" <?php if($sexo == "Hombre") { echo "selected";} ?>>Hombre</option>
											<option value="Mujer" <?php if($sexo == "Mujer") { echo "selected";} ?>>Mujer</option>
										</select><br>
										<label class="mt-2">Página web → Ejemplo: http://www.google.es</label><br><input class="w-100" type="text" name="web" value="<?php echo $pagina; ?>"><br>
										<label class="mt-2">ID de Nintendo </label><br><input class="w-100" type="text" name="nintendo" value="<?php echo $nintendo; ?>"><br>
										<label class="mt-2">ID de PlayStation Network </label><br><input class="w-100" type="text" name="sony" value="<?php echo $psn; ?>"><br>
										<label class="mt-2">ID de Steam </label><br><input class="w-100" type="text" name="steam" value="<?php echo $steam; ?>"><br>
										<label class="mt-2">ID de XBox Live </label><br><input class="w-100" type="text" name="xlive" value="<?php echo $xlive; ?>"><br>
									</div>
									<div class="tab-pane container text-left mt-5" id="passwd">
										<h1 class="">Cambiar contraseña (No implementado)</h1>
										<label >Contraseña actual</label><br><input class="w-100" disabled name="oldPW" type="password"><br>
										<label class="mt-2">Nueva contraseña</label><br><input class="w-100" disabled name="newPW" type="password"><br>
										<label class="mt-2">Repetir nueva contraseña</label><br><input class="w-100" disabled type="password"><br>
									</div>
									<div class="tab-pane container mt-5" id="configurar">
										<h1 class="">CONFIGURACIÓN DEL FORO</h1>
										<label>Elegir tema (aspecto visual del foro)</label><br>
										<select name="tema" class="w-100" >
											<option value="Oficial" <?php if($tema == "Oficial") { echo "selected";} ?>>Oficial</option>
											<option value="Nada" <?php if($tema == "Nada") { echo "selected";} ?>>Nada (bajo consumo de red)</option>
										</select><br>
										<label class="mt-2">Formato de fechas</label><br>
										<select name="fecha" class="w-100" >
											<option value="DD/MM/YYYY" <?php if($fecha == "DD/MM/AAAA") { echo "selected";} ?>>DD/MM/AAAA</option>
											<option value="MM/DD/YYYY" <?php if($fecha == "MM/DD/AAAA") { echo "selected";} ?>>MM/DD/AAAA</option>
											<option value="YYYY/MM/DD" <?php if($fecha == "YYYY/MM/DD") { echo "selected";} ?>>YYYY/MM/DD</option>
										</select><br>
										<label class="mt-2">Zona horaria</label><br>
										<select name="horario" class="w-100" >
											<option value="+12" <?php if($hora == "+12") { echo "selected";} ?>>+12</option><option value="+11" <?php if($hora== "+11") { echo "selected";} ?>>+11</option>
											<option value="+10" <?php if($hora== "+10") { echo "selected";} ?>>+10</option><option value="+9" <?php if($hora== "+9") { echo "selected";} ?>>+09</option>
											<option value="+8" <?php if($hora== "+8") { echo "selected";} ?>>+08</option><option value="+7" <?php if($hora== "+7") { echo "selected";} ?>>+07</option>
											<option value="+6" <?php if($hora== "+6") { echo "selected";} ?>>+06</option><option value="+5" <?php if($hora== "+5") { echo "selected";} ?>>+05</option>
											<option value="+4" <?php if($hora== "+4") { echo "selected";} ?>>+04</option><option value="+3" <?php if($hora== "+3") { echo "selected";} ?>>+03</option>
											<option value="+2" <?php if($hora== "+2") { echo "selected";} ?>>+02</option><option value="+1" <?php if($hora== "+1") { echo "selected";} ?>>+01</option>
											<option value="0" <?php if($hora== "0") { echo "selected";} ?>>+00</option>
											<option value="-1" <?php if($hora== "-1") { echo "selected";} ?>>-01</option><option value="-2" <?php if($hora== "-2") { echo "selected";} ?>>-02</option>
											<option value="-3" <?php if($hora== "-3") { echo "selected";} ?>>-03</option><option value="-4" <?php if($hora== "-4") { echo "selected";} ?>>-04</option>
											<option value="-5" <?php if($hora== "-5") { echo "selected";} ?>>-05</option><option value="-6" <?php if($hora== "-6") { echo "selected";} ?>>-06</option>
											<option value="-7" <?php if($hora== "-7") { echo "selected";} ?>>-07</option><option value="-8" <?php if($hora== "-8") { echo "selected";} ?>>-08</option>
											<option value="-9" <?php if($hora== "-9") { echo "selected";} ?>>-09</option><option value="-10" <?php if($hora== "-10") { echo "selected";} ?>>-10</option>
											<option value="-11" <?php if($hora== "-11") { echo "selected";} ?>>-11</option><option value="-12" <?php if($hora== "-12") { echo "selected";} ?>>-12</option>
										</select><br>
										<label class="mt-2">Mensajes por página</label><br>
										<select name="cantidad" class="w-100" >
											<option value="25" <?php if($mensajes == "25") { echo "selected";} ?>>25</option>
											<option value="50" <?php if($mensajes== "50") { echo "selected";} ?>>50</option>
											<option value="100" <?php if($mensajes== "100") { echo "selected";} ?>>100</option>
										</select><br>
										<label class="mt-2">Mostrar primero (mensajes antiguos o mensajes nuevos)</label><br>
										<select name="ordenar"  class="w-100" >
											<option value="Ascendiente" <?php if($orden == "Ascendiente") { echo "selected";} ?>>Ascendiente</option>
											<option value="Descendiente" <?php if($orden == "Descendiente") { echo "selected";} ?>>Descendiente</option>
										</select><br>
									</div>
								</div>
					
								<div class='col-12 p-0 b-transluced mt-5 text-center'>
									<input type="submit" class="col-12 text-white btn btn-primary" value="GUARDAR">
								</div>
							</form>
						</div>
						<!-- ------------------------------------------------------------------------------ -->
					</div>
					
					<div class="table-dark p-2 rounded tab-pane container mt-5" id="contact">
						<h1 class="bg-warning-custom rounded text-dark text-left pl-2 pb-1">Información de contacto</h1>
						<h3>NO IMPLEMENTADO</h3>
					</div>
					
					<div class="table-dark p-2 rounded tab-pane container mt-5" id="collection">
						<h1 class="bg-warning-custom rounded text-dark text-left pl-2 pb-1">Colección del usuario</h1>
						<h3>NO IMPLEMENTADO</h3>
					</div>
				</div>
			</div>
		</div>
        
        <?php include "footer.php"; ?>
   
    </body>
</html>