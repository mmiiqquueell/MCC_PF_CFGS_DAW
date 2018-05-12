<header class="row m-0">
    <nav class="col-12 navbar b-transluced navbar-expand-md">
        <a class="col-2 navbar-brand text-center" href="index.php">
            <span class="logo1">R</span><span class="logo2">ETRO GAMING FORUM</span>
        </a>
        <form class="col-5 row form-inline mx-auto" action="">
            <div class="col-12 input-group">
                <input class="col-12 form-control" type="text">
                 <div class="input-group-prepend">
                    <button class="col-12 btn btn-success rounded-right input-group-prepend" type="submit">Buscar</button>
                </div>
            </div>
        </form>
        <ul class='col-5 row navbar-nav'>
        	<li class='nav-item col-5'>
        <?php
         if(isset($_SESSION['user'])){
         	echo "<a class='nav-link btn btn-primary' href='index.php?controller=vistas&action=perfil'>".$_SESSION['user']."</a>
            </li>
            <li class='nav-item col-5'>
                <a class='nav-link btn btn-primary' href='index.php?controller=vistas&action=salir'>Cerrar sesión</a>";
         } 
         else{
        	echo "<a class='nav-link btn btn-primary' href='index.php?controller=vistas&action=pantalla_login'>Iniciar Sesión</a>
            </li>
            <li class='nav-item col-5'>
                <a class='nav-link btn btn-primary' href='index.php?controller=vistas&action=registrar'>Registrarse</a>";}
		 ?>
		 </li>
            <li class='nav-item col-1'>
                <button id='CRT' class='btn btn-info mr-1 mb-1 CRT' value='CRT' data-toggle='tooltip' title='Activa/Desactiva efecto CRT'></button>
            </li>
        </ul>
       
    </nav>
    <nav class='col-12 navbar-expand-sm'>
       <ul class='col-12 navbar-nav'>
        <?php
            foreach ($temas as $categorias){
            echo "
                <a class='col-1 text-center rounded bg-warning p-1 pb-2 mx-auto' href='index.php?controller=vistas&action=indica&id=".$categorias['id']."'>
					<li>
                   		<span class='font-weight-bold text-dark'>".$categorias['nombre']."</span>
                	</li>
				</a>";}
		    ?>
        </ul>
    </nav>
</header>