<header>
    <p>APLICACIÓN FINAL</p>
    <h2>ERROR</h2>
    <form>
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion"/>
    </form>
</header>
<main>
        <h2>Código de error: <span class="error-valor"><?php echo $avError['codError']; ?></span></h2>
        <h2>Descripción: <span class="error-valor"><?php echo $avError['descError']; ?></span></h2>
        <h2>Archivo: <span class="error-valor"><?php echo $avError['archivoError']; ?></span></h2>
        <h2>Línea: <span class="error-valor"><?php echo $avError['lineaError']; ?></span></h2>
    <form>
        <input type="submit" name="volver" value="Volver"/>
    </form>
</main>