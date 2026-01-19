<?php

    // Si se intenta acceder a la página sin iniciar sesión resirige a la Inicio publico.
    if(empty($_SESSION['usuarioDAW202LoginLogoff'])) {
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Redirige a la página de inicio.
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
        header("location: indexLoginLogoff.php");  
        exit;
    }
    
    // Variable que guarda el valor de la cookie idioma.
    $idioma= $_COOKIE['idioma'] ?? 'es'; // Español por defecto.

    // Código que se ejecuta al pulsar el botón cerrar sesión
    if(isset($_REQUEST['cerrarSesion'])){
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Si se pulsa le damos el valor a la página solicitada a la variable $_SESSION
        $_SESSION['paginaEnCurso']='inicioPublico';
        header("location: indexLoginLogoff.php");  
        exit;
    }
    
    // Código que se ejecuta al pulsar el boton detalle.
    if(isset($_REQUEST['detalle'])){
        $_SESSION['paginaAnterior'] =$_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso']='detalle';
        header("location: indexLoginLogoff.php");  
        exit;
    }

    // Código que se ejecuta al pulsa el botón de Error.
    if(isset($_REQUEST['error'])){
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
        $consultaError = "SELECT * FROM T03_Cuestion";
        DBPDO::ejecutarConsulta($consultaError);
        $_SESSION['paginaEnCurso'] = 'error';
        header('Location: indexLoginLogoff.php');
        exit;
    }

    // Codigo que se ejecuta cuando pulsamos el boton REST.
    if(isset($_REQUEST['rest'])){
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'api';
        header('Location: indexLoginLogoff.php');
        exit;
    }
    
    // Código que se ejecuta al pulsar el botón de mantenimiento de departamentos.
    if(isset($_REQUEST['mantenimientoDep'])){
        $_SESSION['paginaAnterior']= $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'departamento';
        header('Location: indexLoginLogoff.php');
        exit;
    }


    $avInicioPrivado=[ // Array que almacena los datos que obtenemos del objeto usuario.
        "descUsuario" => $_SESSION['usuarioDAW202LoginLogoff'] -> getDescUsuario(),
        "numAccesos" => $_SESSION['usuarioDAW202LoginLogoff'] -> getNumAccesos(),
        "fechaHoraUltimaConexionAnterior" => $_SESSION['usuarioDAW202LoginLogoff'] -> getFechaHoraUltimaConexionAnterior()
    ];

    // Array que almacena los datos para formar el mensaje de bienvenida.
    $avMensajeBienvenida=[
        'bienvenida' =>'',
        'conexiones' =>'',
        'ultimaConexion' =>''
    ];

    switch($idioma){
        case 'es':
            $avMensajeBienvenida['bienvenida'] = "Bienvenido " . $avInicioPrivado['descUsuario'];
            if($avInicioPrivado['numAccesos']<=1){
                $avMensajeBienvenida['conexiones'] = "! Esta es la primera vez que te conectas !";
            }else{
                // Si fechaAnterior ya es un objeto DateTime no hace falta hacer el "new DateTime", se puede usar:
                if($avInicioPrivado['fechaHoraUltimaConexionAnterior'] instanceof DateTime){
                    // Formatear la fecha y hora según la configuración regional española
                    // IntlDateFormatter::FULL - muestra la fecha completa (día de la semana, día, mes y año)
                    // IntlDateFormatter::LONG - mostraría la fecha (día, mes y año)
                    // IntlDateFormatter::MEDIUM - mostraría la fecha abreviada (ejemplo:12 ene 2025)
                    // IntlDateFormatter::NONE - no muestra la hora
                    $oFormatoFecha=new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                    $fecha=$oFormatoFecha->format($avInicioPrivado['fechaHoraUltimaConexionAnterior']);
                    $hora = $avInicioPrivado['fechaHoraUltimaConexionAnterior']->format('H:i');
                    $avMensajeBienvenida['conexiones'] = "Esta es la " . $avInicioPrivado['numAccesos'] . " vez que te conectas";
                    $avMensajeBienvenida['ultimaConexion'] = "Usted se conecto por última vez el   " . $fecha . " a las ". $hora;
                }
                
            }
            break;
        case 'en':
            $avMensajeBienvenida['bienvenida'] = "Welcome " . $avInicioPrivado['descUsuario'];
            if($avInicioPrivado['numAccesos']<=1){
                $avMensajeBienvenida['conexiones'] = "This is your first conection !";
            }else{
                if($avInicioPrivado['fechaHoraUltimaConexionAnterior'] instanceof DateTime){
                    $oFormatoFecha=new IntlDateFormatter('en_GB', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                    $fecha=$oFormatoFecha->format($avInicioPrivado['fechaHoraUltimaConexionAnterior']);
                    $hora = $avInicioPrivado['fechaHoraUltimaConexionAnterior']->format('H:i');
                    $avMensajeBienvenida['conexiones'] = "This is " . $avInicioPrivado['numAccesos'] . " time you have conected";
                    $avMensajeBienvenida['ultimaConexion'] = "You last concted on " . $fecha . " at ". $hora;
                }
            }
            break;
        case 'pt':
            $avMensajeBienvenida['bienvenida'] = "Bem-vindo " . $avInicioPrivado['descUsuario'];
            if($avInicioPrivado['numAccesos']<=1){
                $avMensajeBienvenida['conexiones'] = "Esta é a sua primeira ligação !";
            }else{
                if($avInicioPrivado['fechaHoraUltimaConexionAnterior'] instanceof DateTime){
                    $oFormatoFecha=new IntlDateFormatter('pt_PT', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                    $fecha=$oFormatoFecha->format($avInicioPrivado['fechaHoraUltimaConexionAnterior']);
                    $hora = $avInicioPrivado['fechaHoraUltimaConexionAnterior']->format('H:i');
                    $avMensajeBienvenida['conexiones'] = "Esta é a " . $avInicioPrivado['numAccesos'] . " que ele se conecta";
                    $avMensajeBienvenida['ultimaConexion'] = "Você fez login pela última vez em " . $fecha . " em ". $hora;
                }
            }
            break;
    }
    
    require_once $view['layout'];
?>