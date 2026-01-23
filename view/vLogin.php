<?php
/** 
 * @author Alejandro De la Huerga
 * @since 16/12/2025
*/
?>
<header>
    <p>APLICACIÓN FINAL</p>
    <h2 id="login">LOGIN</h2>
</header>
<main id="mainLogin">
    <div id="divLogin">
        <h1>Iniciar Sesión</h1>
        <div id="formularioLogin">
            <form name="formularioLogin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div id="entradasLogin">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" value="<?php echo $_REQUEST['usuario'] ?? '' ?>" class="entradaDatos" placeholder="Nombre de usuario" />
                    <span class="error" id="erroresFormulario"><?php echo $aErrores['usuario'] ?? '' ?></span>
                    <br>
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" value="<?php echo $_REQUEST['password'] ?? '' ?>" class="entradaDatos" placeholder="Contraseña" />
                    <span class="error" id="erroresFormulario"><?php echo $aErrores['password'] ?? '' ?></span>
                </div>
                <div id="botonesLogin">
                    <div id="entrarCancelar">
                        <input type="submit" name="entrar" value="INICIAR SESIÓN" />
                        <input type="submit" name="cancelar" value="CANCELAR" />
                    </div>
                    <div id="o">O</div>
                    <p id="sincuenta">¿No tienes cuenta?</p>
                    <input type="submit" name="registrarse" value="CREAR CUENTA" />
                </div>
            </form>
        </div>
    </div>
</main>