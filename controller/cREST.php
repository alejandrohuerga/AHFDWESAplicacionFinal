<?php
    // Si se intenta acceder a la página sin iniciar sesión resirige a la Inicio publico.
    if(empty($_SESSION['usuarioDAW202LoginLogoff'])) {
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Redirige a la página de inicio.
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
        header("location: index.php");  
        exit;
    }

    // Código que se ejecuta al pulsar cerrar sesión
    if(isset($_REQUEST['cerrarSesion'])){
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Si se pulsa le damos el valor a la página solicitada a la variable $_SESSION
        $_SESSION['paginaEnCurso']='inicioPublico';
        header("location: index.php");  
        exit;
    }

    // Código que se ejecuta al pulsar el botón volver.
    if(isset($_REQUEST['volver'])){
        $_SESSION['paginaEnCurso']='inicioPrivado';
        header("location: index.php");  
        exit;
    }

    $aErrores = [
        'fechaNasa' => null
    ];

    $oFotoNasa = null;

    // Obtenemos la fecha de hoy para valores por defecto.
    $fechaHoy=new DateTime();
    $fechaHoyFormateada=$fechaHoy -> format('Y-m-d');
    $fechaNasa = $fechaHoyFormateada; // Por defecto hoy.

    // Validación al darle al botón enviar de la Nasa
    if(isset($_REQUEST['enviarNasa'])){
        $entradaOK = true;
        $aErrores['fechaNasa'] = validacionFormularios::validarFecha($_REQUEST['fechaNasa'], $fechaHoyFormateada, '1995-06-16', 1);

        if ($aErrores['fechaNasa'] != null) {
            $entradaOK = false;
        }

        if ($entradaOK) {
            $fechaNasa = $_REQUEST['fechaNasa'];
        }
    }

    $oFotoNasa=REST::apiNasa($fechaNasa);

    

    $avRestNasa =[
        'fechaHoy' => $fechaHoyFormateada,
        'tituloNasa' => ($oFotoNasa) ? $oFotoNasa->getTitulo() : "No hay datos",
        'fotoNasa' => ($oFotoNasa) ? $oFotoNasa->getFoto() : "",
        'fechaNasa' => $fechaNasa,
        'explicacionNasa' => ($oFotoNasa) ? $oFotoNasa->getExplicacion() : "",
        'errorNasa' => $aErrores['fechaNasa'],
    ];

    

    require_once $view['layout'];
?>