<header>
    <p>APLICACIÓN FINAL</p>
    <h2>MANTENIMIENTO DEPARTAMENTOS</h2>
    <form>
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion" />
    </form>
</header>
<main>
    <form name="formulario">
        <label class="buscar" for="Descripción Departamento">
            <input type="text" name="DescDepBuscado" class="buscar" value="<?php  if($descBuscada != ""){echo $descBuscada ;} ?>"/>
            <input type="submit" name="descBuscado" value="Buscar">
        </label>
        <br/>
    </form>
    <table id="tablaBuscarDep">
        <tr>
            <th>Codigo Departamento</th>
            <th>Descripcion del Departamento</th>
            <th>Fecha Alta</th>
            <th>Volumen del Negocio</th>
            <th>Fecha Baja</th>
            <th>Ver</th>
            <th>Estado</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
        <?php foreach ($aDepartamentos as $oDepartamento): ?>
            <tr>
                <td><?= $oDepartamento->getCodDepartamento() ?></td>
                <td><?= $oDepartamento->getDescDepartamento() ?></td>
                <td><?= $oDepartamento->getFechaCreacionDepartamento() ?></td>
                <td><?= $oDepartamento->getVolumenNegocio() ?></td>
                <td><?= $oDepartamento->getFechaBajaDepartamento() ?? '—' ?></td>
                <td>
                    <button type="button" class="botonCrudDep" style="background: #f0972b; border:none;">
                        <img src="webroot/images/icon-ojo.png" alt="Descripción del botón" style="height: 40px; width: 40px;">
                    </button>
                </td>
                <td></td>
                <td>
                    <button type="button" class="botonCrudDep" style="background: #f0972b; border:none;">
                        <img src="webroot/images/icon-editar.png" alt="Descripción del botón" style="height: 40px; width: 40px;">
                    </button>
                </td>
                <td>
                    <button type="button" class="botonCrudDep" style="background: #f0972b; border:none;">
                        <img src="webroot/images/icon-eliminar.png" alt="Descripción del botón" style="height: 40px; width: 40px;">
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <form>
        <input type="submit" name="volver" value="Volver" />
    </form>
</main>