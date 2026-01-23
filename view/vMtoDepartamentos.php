<header>
    <p>APLICACIÓN FINAL</p>
    <h2>MANTENIMIENTO DEPARTAMENTOS</h2>
    <form>
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion" />
    </form>
</header>
<main>
    <form name="formulario">
        <label class="buscar" for="Codigo Departamento">
            <input type="text" name="CodDepBuscado" class="buscar"/>
            <input type="submit" name="codBuscado" value="Buscar">
        </label>
        <br />
    </form>
    <table>
        <tr>
            <th>Codigo Departamento</th>
            <th>Descripcion del Departamento</th>
            <th> Fecha Alta</th>
            <th>Volumen del Negocio</th>
            <th>Fecha Baja</th>
        </tr>
        <tr>
            <?php echo '<td>'.$avRestDepartamento['codigoDep'] .'</td>' ?>
            <?php echo '<td>'.$avRestDepartamento['descDep'] .'</td>' ?>
            <?php echo '<td>'.$avRestDepartamento['fechaCreacionDep'] .'</td>' ?>
            <?php echo '<td>'.$avRestDepartamento['volumenDep'] .'</td>' ?>
            <?php echo '<td>'.$avRestDepartamento['fechaBajaDep'] .'</td>' ?>
        </tr>
    </table>
    <form>
        <input type="submit" name="volver" value="Volver" />
    </form>
</main>