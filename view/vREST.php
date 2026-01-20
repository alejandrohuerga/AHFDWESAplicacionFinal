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
        <div class="Rest" id="pokemon">
            <h2>POKEMON</h2>
            <div class="tituloRest">
                <form name="formularioPokemon" method="post">
                    <label for="pokemonNombre">Nombre: </label>
                    <input class="formulariosApi" type="text" name="pokemonNombre" value="<?php echo $avRestPokemon['nombrePokemon']?>"/>
                    <span style="color: red;" class="error rojo"><?php echo $avRestPokemon['errorPokemon'] ?></span>
                    <input type="submit" name="enviarPokemon" value="enviar">
                </form>
                <?php echo '<h2 id="tituloFotoNasa">' . $avRestPokemon['nombrePokemon']. '</h2>' ?>
            </div>
            <div class="infoResPokemon">
                <model-viewer src="<?php echo $avRestPokemon['modelo3D']?>" alt="Un modelo 3D" camera-controls autoplay shadow-intensity="1"></model-viewer>
            </div>
            <div id="descripcionFotoNasa">
                <?php echo '<h2 id="descripcionNasa">FORMA: ' .  $avRestPokemon['forma']. '</h2>'?>
            </div>
            <div class="infoApi">
                <p><b>Instrucciones de uso:</b> <a target="blank" href="https://github.com/Pokemon-3D-api/api-server" id="urlNasa"> https://github.com/Pokemon-3D-api/api-server</a></p>
                <p><b>Parámetros:</b>Nombre del Pokemon</p>
                <p><b>Método:</b> GET</p>
            </div>
        </div>
        <div class="Rest" id="propia">
            <h2>API PROPIA</h2>
        </div>
    </section>
    <form>
        <input type="submit" name="volver" value="Volver" />
    </form>
</main>