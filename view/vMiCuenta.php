<header>
    <p>APLICACIÓN FINAL</p>
    <h2>MI CUENTA</h2>
    <form>
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion" />
    </form>
</header>
<main>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="formularioMiCuenta" enctype="multipart/form-data">
        <label for="imagen">Imagen actual:</label><br>
        <?php if (!empty($avUsuario['imagenUsuario'])): ?>
            <img src="data:image/jpeg;base64,<?= base64_encode($avUsuario['imagenUsuario']) ?>" width="50" height="50" style="border-radius:50%; background:white; object-fit:cover;">
        <?php else: ?>
            <img src="webroot/images/default.png" width="50" height="50"style="border-radius:50%; object-fit:cover;">
        <?php endif; ?>
        <br><br>
        <label for="CodUsuario">Usuario:</label><br>
        <input class="campos" type="text" id="CodUsuario" name="CodUsuario" readonly value="<?php  echo $avUsuario['codUsuario'] ?>">
        <br>
        <label for="DescUsuario" >Descripción del usuario (Editable)</label><br>
        <input class="campos" type="text" id="DescUsuario" name="DescUsuario" value="<?php  echo $avUsuario['descUsuario'] ?>">
        <span class="error" id="erroresFormulario"><?php echo $errorDescripcion ?? '' ?></span>
        <br>
        <label for="NumConexiones">Número de conexiones</label><br>
        <input class="campos" type="text" id="NumConexiones" name="NumConexiones" readonly value="<?php  echo $avUsuario['numConexiones'] ?>">
        <br>
        <label for="FechaHoraUltimaConexion">Fecha Hora Última Conexión (*)</label><br>
        <input class="campos" type="text" id="FechaHoraUltimaConexion" name="FechaHoraUltimaConexion" readonly value="<?php  echo $avUsuario['fechaHoraUltimaConexion'] ?>">
        <br>
        <label for="imagen">Imagen (Editable)</label><br>
        <input class="campos" type="file" id="imagen" name="imagen">
        <span class="error" id="erroresFormulario"><?php echo $errorImagen ?? '' ?></span>
        <br>
        <div id="editarCancelar">
            <input type="submit" name="editarCuenta" value="EDITAR CUENTA"/>
            <input type="submit" name="cancelar" value="CANCELAR" />
            <input type="submit" name="borrarCuenta" value="BORRAR CUENTA"/>
        </div>   
    </form>
</main>