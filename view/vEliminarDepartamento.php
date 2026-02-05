<header>
    <p>APLICACIÓN FINAL</p>
    <h2>ELIMINAR DEPARTAMENTO</h2>
    <form>
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion" />
    </form>
</header>
<main>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="formularioEliminar">
        <h2>Mostrar / Editar Departamento</h2>
        <div class="campo">
            <label for="CodDepartamento">Código:</label>
            <input type="text" id="CodDepartamento" name="CodDepartamento" value="<?= $aVDepartamento['codDepartamento'] ?>" disabled >
        </div>

        <div class="campo">
            <label for="DescDepartamento">Descripción:</label>
            <input type="text" id="DescDepartamento" name="DescDepartamento" value="<?= $aVDepartamento['descDepartamento'] ?>" disabled >
        </div>

        <div class="campo">
            <label for="FechaAlta">Fecha de Alta:</label>
            <input type="text" id="FechaAlta" name="FechaAlta" value="<?= $aVDepartamento['fechaAltaDepartamento'] ?>" disabled>
        </div>

        <div class="campo">
            <label for="VolumenNegocio">Volumen de Negocio:</label>
            <input type="text" id="VolumenNegocio" name="VolumenNegocio" value="<?= $aVDepartamento['volumenDepartamento'] ?>" disabled>
        </div>

        <div class="campo">
            <label for="FechaBaja">Fecha de Baja:</label>
            <input type="text" id="FechaBaja" name="FechaBaja" value="<?= $aVDepartamento['fechaBajaDepartamento'] ?>" disabled>
        </div>
        <div class="botones">
            <input type="submit" name="volver" value="Volver" />
            <input type="submit" name="eliminarDep" value="Eliminar"/>
        </div>
    </form>
</main>

