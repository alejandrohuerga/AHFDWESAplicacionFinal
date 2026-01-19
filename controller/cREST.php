<?php
    // Si se intenta acceder a la página sin iniciar sesión resirige a la Inicio publico.
    if(empty($_SESSION['usuarioDAW202LoginLogoff'])) {
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Redirige a la página de inicio.
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
        header("location: indexLoginLogoff.php");  
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

    /*
    //se obtiene la fecha de hoy
    $fechaHoy = new DateTime();
    $fechaHoyFormateada = $fechaHoy->format('Y-m-d');
    //se llama a la api con la fecha formateada
    $oFotoNasa = REST::apiNasa($fechaHoyFormateada);

    //Se crea un array con los datos del usuario para pasarlos a la vista
    $avRest = [
        'fotoNasa'=>$oFotoNasa
    ];
    */

    $aErroresNasa = [
        'fechaFoto' => ''
    ];

    $aRespuestasNasa = [
        'fechaFoto' => null
    ];

    // Inicializamos la foto de hoy
    $fechaHoy = date('Y-m-d');
    $oFotoNasaHoy = REST::apiNasa($fechaHoy); // Llama a la API con la fecha de hoy
    $avRestNasa = [
        'fotoNasa' => $oFotoNasaHoy
    ];

    define('OBLIGATORIO', 1);
    $entradaOK = true;

    // Fecha de hoy por defecto si no hay formulario enviado
    $fechaFoto = $_REQUEST['fechaFoto'] ?? $fechaHoy;

    // Si el formulario se envía
    if (isset($_REQUEST['enviar'])) {
        /**
         *  Function preg_match()
         *  Enlace a la documentación oficial: https://www.php.net/manual/en/function.preg-match.php
         *  
         *  Esta función se utiliza para validar el formato de la fecha introducida por el usuario.
         *  @param String $pattern Patrón que queremos que siga lo ingresado.
         *  @param String $fechaFoto Cadena de texto que le pasamos para comprobar el patrón.
         *  @return int Devuelve 1 si coincide con el patrón, 0 si no coincide.
         */
        
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaFoto)) {
            $aErroresNasa['fechaFoto'] = "Formato de fecha inválido. YYYY-mm-dd";
            $entradaOK = false;
        } else {
            // Validar rango de fechas usando tu librería
            $aErroresNasa['fechaFoto'] = validacionFormularios::validarFecha(
                $fechaFoto,
                date('d-m-Y'),  // Fecha máxima = hoy
                '01/01/1995',   // Fecha mínima
                OBLIGATORIO
            );

            // Comprobar errores
            foreach ($aErroresNasa as $campo => $error) {
                if ($error !== null) {
                    $entradaOK = false;
                } else {
                    $aRespuestasNasa[$campo] = $fechaFoto;
                }
            }
        }
    }

    // Llamamos a la API si la fecha es válida o si es la primera carga
    if ($entradaOK || !isset($_REQUEST['enviar'])) {
        $oFotoNasa = REST::apiNasa($fechaFoto);

        if ($oFotoNasa !== null) {
            $avRestNasa['fotoNasa'] = $oFotoNasa;
        } else {
            // Si no hay imagen para la fecha
            $aErroresNasa['fechaFoto'] = 'No hay imagen disponible para esta fecha';
            $avRestNasa['fotoNasa'] = null;
        }
    }
    
    require_once $view['layout'];
?>