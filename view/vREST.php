<header>
    <p>LOGIN LOGOFF</p>
    <h2>ERROR</h2>
    <form>
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion" />
    </form>
</header>
<main>
    <section id="apis">
        <div class="Rest" id="nasa">
            <h2>NASA</h2>
            <div class="tituloRest">
                <form name="formularioNasa" method="post">
                    <input class="formulariosApi" type="text" name="fechaFoto" value="<?= date('Y-m-d') ?? $_REQUEST['fechaFoto']; ?>"/>
                    <input type="submit" name="enviar" value="enviar">
                    <a style="color:red;">
                        <?php echo (isset($_REQUEST['enviar'])) ? $aErroresNasa['fechaFoto'] : ''; ?>
                    </a>
                </form>
                <?php echo '<h2 id="tituloFotoNasa">' . $avRestNasa['fotoNasa'] -> getTitulo(); '</h2>' ?>
            </div>
            <div class="infoRest">
                <img src="<?php echo $avRestNasa['fotoNasa']->getFoto(); ?>" alt="Foto de la NASA" width="300px" height="200px">
            </div>
            <div id="descripcionFotoNasa">
                <?php echo '<p id="descripcionNasa">' .  $avRestNasa['fotoNasa'] -> getExplicacion(); '</p>'?>
            </div>
            <div class="infoApi">
                <p><b>Instrucciones de uso:</b> <a target="blank" href=" https://api.nasa.gov" id="urlNasa"> https://api.nasa.gov</a></p>
                <p><b>Parámetros:</b> Fecha</p>
                <p><b>Método:</b> GET</p>
            </div>
        </div>
        <div class="Rest" id="aemet">
            <h2>AEMET</h2>
            
        </div>
        <div class="Rest" id="propia">
            <h2>API PROPIA</h2>
        </div>
    </section>
    <form>
        <input type="submit" name="volver" value="Volver" />
    </form>
</main>