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
            <h2 class="bg-warning-custom rounded">Creación de cuenta</h2>
            <form>
                <input type="text" name="usuario" placeholder="Nombre de usuario"/><br><br>
                <input type="password" name="password" placeholder="Contraseña"/> 
                <input type="password" name="rpassword" placeholder="Repetir Contraseña"/><br><br>
                <input type="text" name="email" placeholder="email"/> 
                <input type="text" name="remail" placeholder="Repetir email"/><br><br>
                <input type="checkbox" name="password" /><br><span>Acepto la <a>politica de privacidad</a></span><br><br>
                <div class="btn btn-white">Captcha</div><br>
                <input type="text" name="captcha" /><br><br>
                <input class="btn btn-warning text-dark" type="submit" name="usuario" value="registrarse" />
            </form>
            
        </main>
        
        <?php include "footer.php"; ?>
    
    
    </body>
</html>