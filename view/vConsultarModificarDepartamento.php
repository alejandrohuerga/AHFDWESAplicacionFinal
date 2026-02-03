<header>
    <p>APLICACIÓN FINAL</p>
    <h2>CONSULTAR MODIFICAR DEPARTAMENTO</h2>
    <form>
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion" />
    </form>
</header>
<main>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="campo">
            <label for="CodDepartamento">Código:</label>
            <input type="text" id="CodDepartamento" name="CodDepartamento" value="<?= $aVDepartamento['codDepartamento'] ?>" readonly style="background-color: #e0e0e0;">
        </div>

        <div class="campo">
            <label for="DescDepartamento">Descripción:</label>
            <input type="text" id="DescDepartamento" name="DescDepartamento" value="<?= $aVDepartamento['descDepartamento'] ?>" readonly>
        </div>

        <div class="campo">
            <label for="FechaAlta">Fecha de Alta:</label>
            <input type="text" id="FechaAlta" name="FechaAlta" value="<?= $aVDepartamento['fechaAltaDepartamento'] ?>" readonly>
        </div>

        <div class="campo">
            <label for="VolumenNegocio">Volumen de Negocio:</label>
            <input type="text" id="VolumenNegocio" name="VolumenNegocio" value="<?= $aVDepartamento['volumenDepartamento'] ?>" readonly>
        </div>

        <div class="campo">
            <label for="FechaBaja">Fecha de Baja:</label>
            <input type="text" id="FechaBaja" name="FechaBaja" value="<?= $aVDepartamento['fechaBajaDepartamento'] ?>" readonly>
        </div>
        <div class="botones">
            <input type="submit" name="volver" value="Volver" class="boton">
        </div>
    </form>
</main>