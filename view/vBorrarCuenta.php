<header>
    <p>APLICACIÓN FINAL</p>
    <h2>BORRAR CUENTA</h2>
    <form>
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion" />
    </form>
</header>
<main>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="formularioMiCuenta" enctype="multipart/form-data">
        <h4>¿Está seguro de querer eliminar su cuenta?</h4>
        
        <label for="Password">Contraseña</label><br>
        <input class="campos" type="password" id="Password" name="Password" value="">
        <span class="error" id="erroresFormulario"><?php echo $errorPassword ?? '' ?></span>
        <br>
        <div id="editarCancelar">
            <input type="submit" name="borrarCuentaPagina" value="BORRAR CUENTA"/>
            <input type="submit" name="cancelar" value="CANCELAR" />
        </div>   
    </form>
</main>