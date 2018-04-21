<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Retro Gaming Forum</title>
        <?php include "bootstrap.php"; ?>
    </head>

    <body class="container">
       <?php include "header.php"; ?>
        
        <main class="pb-2 text-center text-white">
            <h2 class="bg-warning-custom rounded">Inicio de sesión</h2>
            <form>
                <label>Usuario</label><br>
                <input type="text" name="usuario" /><br><br>
                <label>Contraseña</label><br>
                <input type="password" name="password" /><br><br>
                <input class="btn btn-primary text-white" type="submit" name="submit" value="iniciar sesión" />
            </form>
            
            <p class="table-secondary-custom-2 rounded mt-3 text-white">¿No tiene cuenta? Pulse <a class="btn btn-warning text-dark badge" href="#">aquí</a> para crear una.</p>
            <p class="table-secondary-custom-2 rounded mt-3 text-white">¿Ha olvidado su contraseña? Pulse <a class="btn btn-light text-dark badge" href="#">aquí</a> para restablecer su contraseña.</p>
        </main>
        
        <?php include "footer.php"; ?>
    
    
    </body>
</html>