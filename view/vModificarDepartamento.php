<header>
    <p>APLICACIÓN FINAL</p>
    <h2>MODIFICAR DEPARTAMENTO</h2>
    <form>
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion" />
    </form>
</header>
<main>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="formularioMostrarEditar">
        <h2>Editar Departamento</h2>
        <div class="campo">
            <label for="CodDepartamento">Código:</label>
            <input type="text" id="CodDepartamento" name="CodDepartamento" value="<?= $aVDepartamento['codDepartamento'] ?>" disabled >
        </div>

        <div class="campo">
            <label for="DescDepartamento">Descripción:</label>
            <input type="text" id="DescDepartamento" name="DescDepartamento" value="<?= $aVDepartamento['descDepartamento'] ?>" style="background:rgb(255, 222, 74); color:black";>
        </div>

        <div class="campo">
            <label for="FechaAlta">Fecha de Alta:</label>
            <input type="text" id="FechaAlta" name="FechaAlta" value="<?= $aVDepartamento['fechaAltaDepartamento'] ?>" disabled>
        </div>

        <div class="campo">
            <label for="VolumenNegocio">Volumen de Negocio:</label>
            <input type="text" id="VolumenNegocio" name="VolumenNegocio" value="<?= $aVDepartamento['volumenDepartamento'] ?>" style="background:rgb(255, 222, 74); color:black";>
        </div>

        <div class="campo">
            <label for="FechaBaja">Fecha de Baja:</label>
            <input type="text" id="FechaBaja" name="FechaBaja" value="<?= $aVDepartamento['fechaBajaDepartamento'] ?>" disabled>
        </div>
        <div class="botones">
            <input type="submit" name="editar" value="Editar" class="boton">
            <input type="submit" name="volver" value="Cancelar" class="boton">
        </div>
    </form>
</main>