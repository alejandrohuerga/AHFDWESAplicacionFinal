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
    <table id="tablaBuscarDep">
        <tr>
            <th>Codigo Departamento</th>
            <th>Descripcion del Departamento</th>
            <th> Fecha Alta</th>
            <th>Volumen del Negocio</th>
            <th>Fecha Baja</th>
        </tr>
        <?php foreach ($aDepartamentos as $oDepartamento): ?>
            <tr>
                <td><?= $oDepartamento->getCodDepartamento() ?></td>
                <td><?= $oDepartamento->getDescDepartamento() ?></td>
                <td><?= $oDepartamento->getFechaCreacionDepartamento() ?></td>
                <td><?= $oDepartamento->getVolumenNegocio() ?></td>
                <td><?= $oDepartamento->getFechaBajaDepartamento() ?? '—' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <form>
        <input type="submit" name="volver" value="Volver" />
    </form>
</main>