<header>
    <p>LOGIN LOGOFF</p>
    <h2>REST</h2>
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
                    <label for="fechaNasa">Fecha: </label>
                    <input class="formulariosApi" type="date" name="fechaNasa" value="<?php echo $avRestNasa['fechaNasa']?>"/>
                    <span style="color: red;" class="error rojo"><?php echo $avRestNasa['errorNasa'] ?></span>
                    <input type="submit" name="enviar" value="enviar">
                </form>
                <?php echo '<h2 id="tituloFotoNasa">' . $avRestNasa['tituloNasa']. '</h2>' ?>
            </div>
            <div class="infoRest">
                <img src="<?php echo $avRestNasa['fotoNasa']?>" alt="Foto de la NASA" width="300px" height="200px">
            </div>
            <div id="descripcionFotoNasa">
                <?php echo '<p id="descripcionNasa">' .  $avRestNasa['explicacionNasa']. '</p>'?>
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