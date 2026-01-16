<header>
    <p>LOGIN LOGOFF</p>
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
        <input type="submit" name="mantenimientoDep" value="Mentenimiento Departamentos"/>
        <input type="submit" name="error" value="Error">
        <input type="submit" name="rest" value="Rest">
    </form>
</main>