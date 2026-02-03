Aquí tienes la vista vMtoDepartamentos.php adaptada. He realizado dos cambios fundamentales para que funcione con tu nuevo controlador:

    Uso de Array: Ahora accede a los datos como $departamento['clave'] en lugar de llamar a métodos del objeto.

    Formulario por fila: Cada icono del "ojo" ahora está envuelto en un pequeño formulario independiente que envía el código específico de ese departamento mediante un input type="hidden".

PHP

<header>
    <p>APLICACIÓN FINAL</p>
    <h2>MANTENIMIENTO DEPARTAMENTOS</h2>
    <form method="post">
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion" />
    </form>
</header>

<main>
    <form name="formulario" method="post">
        <label class="buscar" for="DescDepBuscado">
            <input type="text" name="DescDepBuscado" class="buscar" value="<?= $descBuscada ?>"/>
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
        <?php if (!empty($aVDepartamentos)): ?>
            <?php foreach ($aVDepartamentos as $departamento): ?>
                <tr>
                    <td><?= $departamento['codDepartamento'] ?></td>
                    <td><?= $departamento['descDepartamento'] ?></td>
                    <td><?= $departamento['fechaAlta'] ?></td>
                    <td><?= $departamento['volumenNegocio'] ?></td>
                    <td><?= $departamento['fechaBaja'] ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="codDepartamentoVer" value="<?= $departamento['codDepartamento'] ?>">
                            <button name="mostrar" type="submit" class="botonCrudDep" style="background: #f0972b; border:none; cursor:pointer;">
                                <img src="webroot/images/icon-ojo.png" alt="Ver" style="height: 40px; width: 40px;">
                            </button>
                        </form>
                    </td>

                    <td></td>

                    <td>
                        <form method="post">
                            <input type="hidden" name="codDepartamentoEditar" value="<?= $departamento['codDepartamento'] ?>">
                            <button name="editar" type="submit" class="botonCrudDep" style="background: #f0972b; border:none; cursor:pointer;">
                                <img src="webroot/images/icon-editar.png" alt="Editar" style="height: 40px; width: 40px;">
                            </button>
                        </form>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="codDepartamentoBorrar" value="<?= $departamento['codDepartamento'] ?>">
                            <button name="borrar" type="submit" class="botonCrudDep" style="background: #f0972b; border:none; cursor:pointer;">
                                <img src="webroot/images/icon-eliminar.png" alt="Borrar" style="height: 40px; width: 40px;">
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="9">No se han encontrado departamentos.</td></tr>
        <?php endif; ?>
    </table>
    <form method="post">
        <input type="submit" name="volver" value="Volver" />
    </form>
</main>