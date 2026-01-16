<header>
    <p>LOGIN LOGOFF</p>
    <h2>ERROR</h2>
    <form>
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion"/>
    </form>
</header>
<main>
    <h2>Código de error: <?php echo $avError['codError']; ?></h2>
    <h2>Descripción: <?php echo $avError['descError']; ?></h2>
    <h2>Archivo: <?php echo $avError['archivoError']; ?></h2>
    <h2>Línea: <?php echo $avError['lineaError']; ?></h2>
    <form>
        <input type="submit" name="volver" value="Volver"/>
    </form>
</main>