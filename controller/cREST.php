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
    $fechaHoy = new DateTime();
    $fechaHoyFormateada = $fechaHoy->format('Y-m-d');
    $fechaNasa = $fechaHoyFormateada; // Por defecto hoy
    $tituloNasa = "No hay datos";
    $explicacionNasa = "";
    $urlHD ="";
    $urlFotoNasa = null;
    // Si NO se ha enviado el formulario
    if (!isset($_REQUEST['enviarNasa'])) {
        if (isset($_SESSION['urlFotoNasa']) && isset($_SESSION['fechaNasaEnCurso'])) {
            // Recuperamos la última búsqueda de la sesión
            $urlFotoNasa = $_SESSION['urlFotoNasa'];
            $fechaNasa = $_SESSION['fechaNasaEnCurso'];
            $tituloNasa = $_SESSION['tituloNasa'] ?? $tituloNasa;
            $explicacionNasa = $_SESSION['explicacionNasa'] ?? $explicacionNasa;
            $urlHD = $_SESSION['urlHD'] ?? $urlHD;
        } else {
            // Primera carga: foto del día
            $oFotoNasa = REST::apiNasa($fechaHoyFormateada);
            if ($oFotoNasa) {
                $tituloNasa = $oFotoNasa->getTitulo();
                $explicacionNasa = $oFotoNasa->getExplicacion();
                $urlHD = $oFotoNasa->getUrlHD();
                $urlFotoNasa = $oFotoNasa->getFoto();
            }
            // Guardamos en sesión
            $_SESSION['urlFotoNasa'] = $urlFotoNasa;
            $_SESSION['fechaNasaEnCurso'] = $fechaHoyFormateada;
            $_SESSION['tituloNasa'] = $tituloNasa;
            $_SESSION['explicacionNasa'] = $explicacionNasa;
            $_SESSION['urlHD'] = $urlHD;
        }
    }

    // Si se envía el formulario de búsqueda
    if (isset($_REQUEST['enviarNasa'])) {
        $entradaOK = true;
        $aErrores['fechaNasa'] = validacionFormularios::validarFecha(
            $_REQUEST['fechaNasa'],
            $fechaHoyFormateada,
            '1995-06-16',
            1
        );
        if ($aErrores['fechaNasa'] != null) {
            $entradaOK = false;
        }
        if ($entradaOK) {
            $fechaNasa = $_REQUEST['fechaNasa'];
            $oFotoNasa = REST::apiNasa($fechaNasa);
            if ($oFotoNasa) {
                $tituloNasa = $oFotoNasa->getTitulo();
                $explicacionNasa = $oFotoNasa->getExplicacion();
                $urlFotoNasa = $oFotoNasa->getFoto();
                $urlHD = $oFotoNasa ->getUrlHD();
            }
            // Guardamos en sesión
            $_SESSION['urlFotoNasa'] = $urlFotoNasa;
            $_SESSION['fechaNasaEnCurso'] = $fechaNasa;
            $_SESSION['tituloNasa'] = $tituloNasa;
            $_SESSION['explicacionNasa'] = $explicacionNasa;
            $_SESSION['urlHD'] = $urlHD;
        } else {
            // Si hay error, usamos último valor guardado
            $urlFotoNasa = $_SESSION['urlFotoNasa'] ?? null;
            $fechaNasa = $_SESSION['fechaNasaEnCurso'] ?? $fechaHoyFormateada;
            $tituloNasa = $_SESSION['tituloNasa'] ?? $tituloNasa;
            $explicacionNasa = $_SESSION['explicacionNasa'] ?? $explicacionNasa;
            $urlHD = $_SESSION['urlHD'] ?? $urlHD;
        }
    }

    // Pasamos a la vista
    $avRestNasa = [
        'fechaNasa' => $fechaNasa,
        'fotoNasa' => !empty($urlFotoNasa) ? $urlFotoNasa :null,
        'tituloNasa' => $tituloNasa,
        'explicacionNasa' => $explicacionNasa,
        'errorNasa' => $aErrores['fechaNasa'] ?? null,
        'mensajeNoFoto' => empty($urlFotoNasa) ? "No hay imagen disponible para esta fecha." : null,
        'urlHD' => $urlHD ?? null
    ];

    

    require_once $view['layout'];
?>