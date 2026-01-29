<header>
    <p>APLICACIÓN FINAL</p>
    <h2>INICIAR PRIVADO</h2>
    <form>
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion" />
    </form>
</header>
<main>
    
    <?php
        echo "<h2>".$avMensajeBienvenida['bienvenida']."</h2>";
        echo "<h2>". $avMensajeBienvenida['conexiones']."</h2>";
        echo "<h2>". $avMensajeBienvenida['ultimaConexion']."</h2>";
    ?> 
    <form>
        <input type="submit" name="detalle" value="Detalle" />
        <input type="submit" name="mantenimientoDep" value="Mantenimiento Departamentos"/>
        <input type="submit" name="error" value="Error">
        <input type="submit" name="rest" value="Rest">
        <input type="submit" name="mtoUsuarios" value="Mantenimiento Usuarios">
        
    </form>
</main>