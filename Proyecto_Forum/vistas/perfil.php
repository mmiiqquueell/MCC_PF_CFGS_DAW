<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Retro Gaming Forum</title>
        <?php include "bootstrap.php"; ?>
    </head>

    <body class="container">
       <?php include "header.php"; ?>
        
        <body class="container">
		<div id="filtro" class="filtro"></div>
        <div class="wrapper borroso">
			<div class="col-12">
				<ul class="col-12 nav nav-pills nav-justified mt-4">
					<li class="col-2 nav-item">
						<a class="nav-link active" data-toggle="pill" href="#avatar">Avatar</a>
					</li>
					<li class="col-2 nav-item">
						<a class="nav-link" data-toggle="pill" href="#info">Información Personal</a>
					</li>
                    <li class="col-2 nav-item">
						<a class="nav-link" data-toggle="pill" href="#config">Configuración</a>
					</li>
					<li class="col-2 nav-item">
						<a class="nav-link" data-toggle="pill" href="#mencion">Menciones</a>
					</li>
                    <li class="col-2 nav-item">
						<a class="nav-link" data-toggle="pill" href="#stats">Estadisticas</a>
					</li>
					<li class="col-2 nav-item">
						<a class="nav-link" data-toggle="pill" href="#mp">Mensajes privados</a>
					</li>
				</ul>
			</div>
			<div class="col-12 text-center">
				<div class="tab-content"><hr>
					<div class="tab-pane active container mt-5" id="avatar">
						<form action="index.php?controller=usuario&action=login" method="post">
							<input class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-2 centext text-center" name="nombre" type="text" placeholder="NOMBRE"/><br>
							<input class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-2 centext text-center" name="password" type="password" placeholder="CONTRASEÑA" /><br><br>
							<input type="submit" value="Iniciar sesion" class="mt-2 btn btn-success col-6 col-sm-5 col-md-4 col-lg-3 col-xl-2" /><br>
							<a href="index.php?controller=vistas&acction=home"><input type="button" value="cancelar" class="mt-5 small btn btn-warning col-6 col-sm-5 col-md-4 col-lg-3 col-xl-2" /></a>
							<br>
						</form>
					</div>
					<div class="tab-pane container mt-5" id="info">
						<form onsubmit="return comprobar()" action="index.php?controller=usuario&action=crear" method="post">
							<input class="col-6 col-sm-5 col-md-5 col-lg-4 col-xl-3 centext text-center" name="nombreCR" type="text" placeholder="NOMBRE COMPLETO" /> 
							<input class="col-6 col-sm-5 col-md-5 col-lg-4 col-xl-3 centext text-center" name="nombreR" type="text" placeholder="NOMBRE USUARIO" /> <br>
							<input class="col-6 col-sm-5 col-md-5 col-lg-4 col-xl-3 centext text-center" name="emailR" type="text" placeholder="E-MAIL"/>
							<input class="col-6 col-sm-5 col-md-5 col-lg-4 col-xl-3 centext text-center" name="direccionR" type="text" placeholder="DIRECCION"/><br>
							<input class="col-6 col-sm-5 col-md-5 col-lg-4 col-xl-3 centext text-center"  name="postalR" type="text" placeholder="CODIGO POSTAL"/><br>
							<input class="col-6 col-sm-5 col-md-5 col-lg-4 col-xl-3 centext text-center"  name="password1R" type="password" placeholder="PASSWORD"/> 
							<input class="col-6 col-sm-5 col-md-5 col-lg-4 col-xl-3 centext text-center"  name="password2R" type="password" placeholder="REPEAT"/><br><br>
							<label>Escribe el resultado de la suma con letras.</label><br>
							<input class="col-2 col-sm-2 col-md-2 col-lg-1 col-xl-1 centext text-center"  type="text" size="10" disabled /> + 
							<input class="col-2 col-sm-2 col-md-2 col-lg-1 col-xl-1 centext text-center"  type="text" size="10" disabled /> = 
							<input class="col-4 col-sm-5 col-md-4 col-lg-3 col-xl-2 centext text-center"  type="text" size="12" /><br>
							<input type="submit" value="Crear cuenta" class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-2 mt-5 btn btn-success" />
							<br><br><br><a href="index.php?controller=vistas&acction=home"><input type="button" value="cancelar" class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-2 mt-5 small btn btn-warning" /></a>
							<br>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
        
        <?php include "footer.php"; ?>
    
    </body>
</html>