<header>
    <p>APLICACIÓN FINAL</p>
    <h2>REGISTRO</h2>
    <form>
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion" />
    </form>
</header>
<main>
    <h2>Bienvenido al Registro</h2>
    <div id="formularioRegistro">
        <form name="formularioRegistro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div id="entradasRegistro">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" value="<?php echo $_REQUEST['usuario'] ?? '' ?>" class="entradaDatos" placeholder="Nombre de usuario" />
                <span class="error" id="erroresFormulario"><?php echo $aErrores['usuario'] ?? '' ?></span>
                <br>
                <label for="password">Contraseña</label>
                <input type="password" name="password" value="<?php echo $_REQUEST['password'] ?? '' ?>" class="entradaDatos" placeholder="Contraseña" />
                <span class="error" id="erroresFormulario"><?php echo $aErrores['password'] ?? '' ?></span>
                <br>
                <label for="password">Descripción</label>
                <input type="descripcion" name="descripcion" value="<?php echo $_REQUEST['descripcion'] ?? '' ?>" class="entradaDatos" placeholder="Descripcion" />
                <span class="error" id="erroresFormulario"><?php echo $aErrores['descripcion'] ?? '' ?></span>
            </div>
        </form>
    </div>
</main>