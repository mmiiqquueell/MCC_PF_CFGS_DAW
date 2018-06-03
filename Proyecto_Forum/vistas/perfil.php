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
					<li class="col-3 nav-item">
						<a class="nav-link active border rounded pt-1" data-toggle="pill" href="#general">Información</a>
					</li>
					<li class="col-3 nav-item">
						<a class="nav-link border rounded pt-1" data-toggle="pill" href="#config">Ajustes</a>
					</li>
                    <li class="col-3 nav-item">
						<a class="nav-link border rounded pt-1" data-toggle="pill" href="#contact">Contacto</a>
					</li>
					<li class="col-3 nav-item">
						<a class="nav-link border rounded pt-1" data-toggle="pill" href="#collection">Colecciones</a>
					</li>
				</ul>
			</div>
			<div class="col-12 text-center">
				<div class="tab-content text-white">
					<div class="table-dark p-2 rounded tab-pane active container row m-0 mt-5" id="general">
						<h1 class="col-12 bg-warning-custom rounded text-dark text-left pl-2 pb-1">Información general</h1>
						<div class='col-2 m-0 d-inline-block align-top mt-5 mb-5'>
							<img src='images/avatares/<?php echo $preferencias['avatar'];?>' class='rounded avatar'>
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
										}
									}
								} 
								$total = (100/$mt)*$m;
								echo "
								<div class='w-100 pb-4 mb-3 mt-2 rounded table-info text-center position-relative'>
									<div class=' p-2 mt-1 m-0 bg-primary position-absolute' style='width:".$total."%'></div>
									<div class='w-100 m-0 rounded text-dark position-absolute'>(".$m.") ".$total."%</div>
								</div>
								<p class='text-left' >Nombre: ".$nombre." </p>
								<p class='text-left' >Registro: ".$registro." </p>
								<p class='text-left' >E-mail: ".$mail." </p>
								<p class='text-left' >Sexo: ".$sexo."</p>
								<p class='text-left' >Edad: ".$edad." </p>
							
						</div>
						<div class='col-5 m-0 d-inline-block m-auto'>
							<p class='text-left' >Página: <a href='".$pagina."'>".$pagina."</a></p>
							<p class='text-left' >Biografia: ".$biografia."</p>
							<p class='text-left' >Nintendo FC/ID: ".$nintendo."</p>
							<p class='text-left' >PlayStation ID: ".$psn."</p>
							<p class='text-left' >Steam ID: ".$steam."</p>
							<p class='text-left' >XLive ID: ".$xlive."</p>
						</div>
						<div class='col-12 m-0 d-inline-block bg-secondary m-auto text-center'> ".$firma."
						</div>
						";
						?>
						
					</div>
					
					<div class="table-dark p-2 rounded tab-pane container mt-5" id="config">
						<h1 class="bg-warning-custom rounded text-dark text-left pl-2 pb-1">Ajustes de usuario</h1>
						<h3>NO IMPLEMENTADO</h3>
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
        
        <?php include "footer.php"; ?>
   
    </body>
</html>