<?php

    // Si se intenta acceder a la página sin iniciar sesión resirige a la Inicio publico.
    if(empty($_SESSION['usuarioDAW202LoginLogoff'])) {
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Redirige a la página de inicio.
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
        header("location: index.php");  
        exit;
    }

    // CODIGO QUE SE EJECUTA AL PULSAR EL BOTON DE BORRAR CUENTA
    if(isset($_REQUEST['borrarCuenta'])){
        $_SESSION['paginaEnCurso'] = 'borrarCuenta';
        header('Location: index.php');
        exit;
    }

    // CÓDIGO QUE SE EJECUTA AL PULSAR EL BOTÓN CANCELAR.
    if(isset($_REQUEST['cancelar'])){
        $_SESSION['paginaEnCurso'] = 'inicioPrivado';
        header('Location: index.php');
        exit;
    }

    // Array que almacena los datos del Usuario en curso para mostrarlos en el formulario.
    $avUsuario=[
        'codUsuario' => $_SESSION['usuarioDAW202LoginLogoff'] -> getCodUsuario(),
        'descUsuario' => $_SESSION['usuarioDAW202LoginLogoff'] -> getDescUsuario(),
        'numConexiones' => $_SESSION['usuarioDAW202LoginLogoff'] -> getNumAccesos(),
        'fechaHoraUltimaConexion' => $_SESSION['usuarioDAW202LoginLogoff'] ->getFechaHoraUltimaConexion() -> format('d/m/Y'),
        'imagenUsuario' => $_SESSION['usuarioDAW202LoginLogoff'] -> getImagenUsuario()
    ];

    $entradaOK = true;
    define("OBLIGATORIO", 1);

    $oUsuarioEnCurso = $_SESSION['usuarioDAW202LoginLogoff'];

    $errorImagen = null;
    $imagenSubida = null;

    if (isset($_REQUEST['editarCuenta'])) {
        // Validación descripción
        $errorDescripcion = validacionFormularios::comprobarAlfaNumerico(
            $_REQUEST['DescUsuario'],
            255,
            3,
            OBLIGATORIO
        );
        // Validación imagen
        if (!empty($_FILES['imagen']['tmp_name'])) {
            $tipo = $_FILES['imagen']['type'];
            if ( $tipo == "image/gif" || $tipo == "image/jpeg" || $tipo == "image/jpg" || $tipo == "image/png") {
                $imagenSubida = file_get_contents($_FILES['imagen']['tmp_name']);
            } else {
                $errorImagen = "Formato incorrecto";
            }
        }

        if ($errorDescripcion != null) {
            $entradaOK = false;
        }

        if ($errorImagen != null) {
            $entradaOK = false;
        }

    } else {
        $entradaOK = false;
    }


    if ($entradaOK) {
        // Modificamos el usuario y recibimos el objeto actualizado
        $usuarioActualizado = UsuarioPDO::modificarUsuario(
            $oUsuarioEnCurso->getCodUsuario(),
            $_REQUEST['DescUsuario'],
            $imagenSubida
        );

        if ($usuarioActualizado !== null) { 
            $_SESSION['usuarioDAW202LoginLogoff'] = $usuarioActualizado;
            $_SESSION['paginaEnCurso'] = 'micuenta';
            header('Location: index.php');
            exit;
        } else {
            $errorFormulario = "No se pudo actualizar el usuario. Inténtelo de nuevo.";
        }
    }

    // Cargamos el layout principal
    require_once $view['layout'];
?>