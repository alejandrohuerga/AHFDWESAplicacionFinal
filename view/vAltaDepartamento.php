<header>
    <p>APLICACIÓN FINAL</p>
    <h2>CREAR DEPARTAMENTO</h2>
    <form>
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion" />
    </form>
</header>
<main>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="formularioAltaDep">
        <h2>Crear Departamento</h2>
        <div class="campo">
            <label for="CodDepartamento">Código:</label>
            <input type="text" id="CodDepartamento" name="CodDepartamento" placeholder="Codigo Departamento" value="<?php $_REQUEST['CodDepartamento'] ?? '' ?>" style="background-color: #ffffcc; color: black;">
            <?php echo isset($aErrores['CodDepartamento']) ? '<p style="color: red; font-size=11px">'. $aErrores['CodDepartamento'].'</p>' : null; ?>
        </div>

        <div class="campo">
            <label for="DescDepartamento">Descripción:</label>
            <input type="text" id="DescDepartamento" name="DescDepartamento" placeholder="Descripcion Departameto" value="<?php $_REQUEST['DescDepartamento'] ?? '' ?>" style="background-color: #ffffcc; color: black;">
            <?php echo isset($aErrores['DescDepartamento']) ? '<p style="color: red; font-size=11px">'. $aErrores['DescDepartamento'].'</p>' : null; ?>
        </div>

        <div class="campo">
            <label for="VolumenNegocio">Volumen de Negocio:</label>
            <input type="text" id="VolumenNegocio" name="VolumenNegocio" placeholder="Volumen Departamento" value="<?php $_REQUEST['VolumenNegocio'] ?? '' ?>" style="background-color: #ffffcc; color: black;">
            <?php echo isset($aErrores['VolumenNegocio']) ? '<p style="color: red; font-size=11px">'. $aErrores['VolumenNegocio'].'</p>' : null; ?>
        </div>
        <div class="botones">
            <input type="submit" name="crearDep" value="Crear Departamento" class="boton">
            <input type="submit" name="volverMostrar" value="Volver" class="boton">
        </div>
    </form>
</main>