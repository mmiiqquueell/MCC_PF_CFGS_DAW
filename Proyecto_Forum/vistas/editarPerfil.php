<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Retro Gaming Forum</title>
        <?php include "bootstrap.php"; ?>
    </head>

    <body class="container">
       <?php include "header.php"; ?>
			<div class="col-12">
				<ul class="col-12 nav nav-pills nav-justified mt-4">
					<li class="col-2 nav-item">
						<a class="nav-link active border rounded pt-1" data-toggle="pill" href="#avatar">Avatar Firma</a>
					</li>
					<li class="col-2 nav-item">
						<a class="nav-link border rounded pt-1" data-toggle="pill" href="#info">Información Personal</a>
					</li>
                    <li class="col-2 nav-item">
						<a class="nav-link border rounded pt-1" data-toggle="pill" href="#config">Configuración del foro</a>
					</li>
					<li class="col-2 nav-item">
						<a class="nav-link border rounded pt-1" data-toggle="pill" href="#mencion">Menciones realizadas</a>
					</li>
                    <li class="col-2 nav-item">
						<a class="nav-link border rounded pt-1" data-toggle="pill" href="#stats">Estadisticas personales</a>
					</li>
					<li class="col-2 nav-item">
						<a class="nav-link border rounded pt-1" data-toggle="pill" href="#mp">Mensajes privados</a>
					</li>
				</ul>
			</div>
			<div class="col-12 text-center">
					<div class="tab-content text-white">
						<div class="table-dark p-2 rounded tab-pane active container mt-5" id="avatar">
							<form class="">
								<h1 class="bg-warning-custom rounded text-dark text-left pl-2 pb-1">AVATAR</h1>
								<p>Elija un avatar personalizado: maximo 100x100px y un peso menor a 100 KB.</p>
								<p>Avatar actual</p>
								<div class="rounded avatar mx-auto mb-2">AVATAR</div>
								<input class="col-12 btn bg-dark pb-0" type="file" name="pic" accept="image/*">

								<h1 class="bg-warning-custom rounded text-dark text-left pl-2 pb-1 mt-4">FIRMA</h1>
								<p>Escriba su firma personalizado: Máximo de 1000 caracteres.</p>
								<textarea class="w-75 rounded m-auto"></textarea>
								<div class='col-12 p-0 b-transluced mt-2 text-center'>
									<input type="submit" class="col-12 text-white btn btn-primary" value="GUARDAR">
								</div>
							</form>
						</div>
						<div class="tab-pane container mt-5" id="info">
							<form class="">
								<h1 class="">INFORMACION PERSONAL</h1>
								<label>Biografia: Cuenta algo sobre ti</label>
								<label>Edad: Fecha de nacimiento</label>
								<label>Mostrar edad</label>
								<label>Sexo</label>
								<label>Página web</label>
								<label>ID de Nintendo</label>
								<label>ID de PlayStation Network</label>
								<label>ID de Steam</label>
								<label>ID de XBox Live</label>
								<button>Cambiar contraseña</button>
								<div class='col-12 p-0 b-transluced mt-2 text-center'>
									<input type="submit" class="col-12 text-white btn btn-primary" value="GUARDAR">
								</div>
							</form>
						</div>
						<div class="tab-pane container mt-5" id="config">
							<form class="">
								<h1 class="">CONFIGURACION DEL FORO</h1>
								<label>Elegir tema (aspecto visual del foro)</label>
								<label>Formato de fechas</label>
								<label>Zona horaria</label>
								<label>Mensajes por página</label>
								<label>Mostrar primero (temas antiguos o temas nuevos)</label>
								<div class='col-12 p-0 b-transluced mt-2 text-center'>
									<input type="submit" class="col-12 text-white btn btn-primary" value="GUARDAR">
								</div>
							</form>
						</div>
						<div class="tab-pane container mt-5" id="mencion">
							<h1 class="">MENCIONES</h1>
							<label>No disponible</label>
						</div>
						<div class="tab-pane container mt-5" id="stats">
							<h1 class="">ESTADISTICAS DE USUARIO</h1>
							<label>Fecha de registro</label>
							<label>Último mensaje</label>
							<label>Total de temas iniciados</label>
							<label>Total de temas iniciados global</label>
							<label>Total de mensajes escrito</label>
							<label>Total de mensajes escritos global</label>
							<label></label>
							<label></label>
						</div>
						<div class="tab-pane container mt-5" id="mp">
							<h1 class="">MENSAJES PRIVADOS</h1>
						</div>
					</div>
			</div>
        
        <?php include "footer.php"; ?>
   
    </body>
</html>