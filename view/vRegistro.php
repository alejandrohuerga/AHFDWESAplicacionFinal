<?php
    /** 
     * @author Alejandro De la Huerga
     * @since 16/12/2025
     * @version 1.0.0
    */
?>
<main id="mainRegistro">
    <div id="divRegistro">
        <h1>CREAR CUENTA</h1>
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
                    <label for="password">Confirmar Contraseña</label>
                    <input type="password" name="confirmarPassword" value="<?php echo $_REQUEST['confirmarPassword'] ?? '' ?>" class="entradaDatos" placeholder="Contraseña" />
                    <span class="error" id="erroresFormulario"><?php echo $aErrores['confirmarPassword'] ?? '' ?></span>
                    <br>
                    <label for="password">Descripción</label>
                    <input type="text" name="descripcion" value="<?php echo $_REQUEST['descripcion'] ?? '' ?>" class="entradaDatos" placeholder="Descripcion" />
                    <span class="error" id="erroresFormulario"><?php echo $aErrores['descripcion'] ?? '' ?></span>
                </div>
                <div id="botonesRegistro">
                    <div id="entrarCancelar">
                        <input type="submit" name="enviar" value="CREAR CUENTA" />
                        <input type="submit" name="cancelar" value="CANCELAR" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>