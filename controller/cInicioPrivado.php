<?php

    // Si se intenta acceder a la página sin iniciar sesión resirige a la Inicio publico.
    if(empty($_SESSION['usuarioDAW202LoginLogoff'])) {
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Redirige a la página de inicio.
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
        header("location: index.php");  
        exit;
    }
    
    
    // Variable que guarda el valor de la cookie idioma.
    $idioma= $_COOKIE['idioma'] ?? 'es'; // Español por defecto.

    // Código que se ejecuta al pulsar el botón cerrar sesión
    if(isset($_REQUEST['cerrarSesion'])){
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Si se pulsa le damos el valor a la página solicitada a la variable $_SESSION
        $_SESSION['paginaEnCurso']='inicioPublico';
        header("location: index.php");  
        exit;
    }
    
    // Código que se ejecuta al pulsar el boton detalle.
    if(isset($_REQUEST['detalle'])){
        $_SESSION['paginaAnterior'] =$_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso']='detalle';
        header("location: index.php");  
        exit;
    }

    // Código que se ejecuta al pulsa el botón de Error.
    if(isset($_REQUEST['error'])){
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
        $consultaError = "SELECT * FROM T03_Cuestion";
        DBPDO::ejecutarConsulta($consultaError);
        $_SESSION['paginaEnCurso'] = 'error';
        header('Location: index.php');
        exit;
    }

    // Codigo que se ejecuta cuando pulsamos el boton REST.
    if(isset($_REQUEST['rest'])){
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'api';
        header('Location: index.php');
        exit;
    }
    
    // Código que se ejecuta al pulsar el botón de mantenimiento de departamentos.
    if(isset($_REQUEST['mantenimientoDep'])){
        $_SESSION['paginaAnterior']= $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'departamento';
        header('Location: index.php');
        exit;
    }

    // Código que se ejecuta cuando pulsamos el boton MtoUsuarios
    if(isset($_REQUEST['mtoUsuarios'])){
        $_SESSION['paginaAnterior']= $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'mtoUsuarios';
        header('Location: index.php');
        exit;
    }

    if(isset($_REQUEST['micuenta'])){
        $_SESSION['paginaAnterior']= $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'micuenta';
        header('Location: index.php');
        exit;
    }

    // Extraemos los datos del objeto que está en la sesión
    $oUsuarioSesion = $_SESSION['usuarioDAW202LoginLogoff'];

    $avInicioPrivado = [
        "descUsuario" => $oUsuarioSesion->getDescUsuario(),
        "numAccesos" => $oUsuarioSesion->getNumAccesos(),
        "fechaHoraUltimaConexionAnterior" => $oUsuarioSesion->getFechaHoraUltimaConexionAnterior(),
        "perfil" => $oUsuarioSesion->getPerfil()
    ];

    $avMensajeBienvenida = [
        'bienvenida' => "Bienvenido " . $avInicioPrivado['descUsuario'],
        'conexiones' => '',
        'ultimaConexion' => ''
    ];

    // LÓGICA DE MENSAJES
    // Si el usuario acaba de registrarse, numAccesos será 1.
    // Si acaba de loguearse por segunda vez, registrarUltimaConexion lo habrá subido a 2.
    if ($avInicioPrivado['numAccesos'] <= 1) {
        $avMensajeBienvenida['conexiones'] = "¡Esta es la primera vez que te conectas!";
    } else {
        $fechaAnterior = $avInicioPrivado['fechaHoraUltimaConexionAnterior'];
        
        if ($fechaAnterior instanceof DateTime) {
            $oFormatoFecha = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
            $fechaTexto = $oFormatoFecha->format($fechaAnterior);
            $horaTexto = $fechaAnterior->format('H:i');
            
            $avMensajeBienvenida['conexiones'] = "Esta es la " . $avInicioPrivado['numAccesos'] . "ª vez que te conectas";
            $avMensajeBienvenida['ultimaConexion'] = "Usted se conectó por última vez el " . $fechaTexto . " a las " . $horaTexto;
        }
    }

    require_once $view['layout'];
?>