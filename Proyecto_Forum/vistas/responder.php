<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Retro Gaming Forum</title>
        <?php include "bootstrap.php"; ?>
    </head>

    <body class="container">
       <?php include "header.php"; ?>
        
        <main class="mt-3 col-12 row b-transluced text-dark p-0 text-left">
            <div class='rounded mb-2 col-12 bg-warning-custom'>
                    <h3 class="font-weight-bold">ATARI > GENERAL > TÍTULO DEL TEMA > RESPONDER</h3>
                </div>
            <form class='col-12 row p-0 pb-2 b-transluced mx-auto'>
                <div class="RLT col-2 pb-0 bg-warning text-center">
                    <h5>OPCIONES</h5>
                </div>
                <div class="RRT col-10 row p-2 pb-2 bg-light mx-auto">
                    <p class="col-12 mt-1 mb-2 p-1 mb-0 border rounded bg-white">Título del tema</p>
                </div>
                <div class="RLB col-2 m-0 pb-3 bg-warning text-center">
                    <button class="btn border"><b>N</b></button> <button class="btn border"><i>I</i></button> <button class="btn border"><s>T</s></button> <button class="btn border">U</button>
                    <button class="btn border"><u>S</u></button> <button class="btn border"><small>P</small></button> <button class="btn border"><big>G</big></button> <button class="btn border"><sup>S</sup></button>
                    <hr>
                    <div>EMOTICONOS</div><br><br><br><br>
                    <hr>
                    <p>DESACTIVAR</p>
                    <input type="checkbox"/> <label>Firma</label><br>
                    <input type="checkbox"/> <label>Iconos</label><br>
                    <input type="checkbox"/> <label>Código</label><br>
                    <input type="checkbox"/> <label>Imagenes</label><br>
                </div>
                <div class="RRB col-10 row p-2 pb-3 bg-light mx-auto">
                    <textarea class="col-12 mt-2 mb-2 p-3 mb-0 border rounded bg-white" placeholder="Mensaje del tema"></textarea>
                </div>
                <div class='col-12 p-0 b-transluced mt-2 text-right'>
                    <input type="submit" class="col-3 text-white btn btn-info" value="VER MENSAJES">
                    <input type="submit" class="col-3 text-dark btn btn-warning" value="VISTA PREVIA">
                    <input type="submit" class="col-3 text-white btn btn-primary" value="RESPONDER">
                </div>
            </form>
                        
            
        </main>
        
        <?php include "footer.php"; ?>
    
    </body>
</html>