<?php 
    /**
     * @author Alejandro De la Huerga
     * @since 14/01/2026
     * 
     * Controlador de la clase Error , administra el mensaje producido voluntariamente.
     */

    // Si se intenta acceder a la página sin iniciar sesión resirige a la Inicio publico.
    if(empty($_SESSION['usuarioDAW202LoginLogoff'])) {
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Redirige a la página de inicio.
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
        header("location: index.php");  
        exit;
    }

    // Código que se ejecuta al pulsar el botón cerrar sesión
    if(isset($_REQUEST['cerrarSesion'])){
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Si se pulsa le damos el valor a la página solicitada a la variable $_SESSION
        $_SESSION['paginaEnCurso']='inicioPublico';
        header("location: index.php");  
        exit;
    }

    if(isset($_REQUEST['volver'])){
        $_SESSION['paginaEnCurso']='inicioPrivado';
        header("location: index.php");  
        exit;
    }

    $avError = [
        'codError' => '',
        'descError' => '',
        'archivoError' => '',
        'lineaError' => '',
        'paginaSiguiente' => ''
    ];
    
    // Almacenamos los datos del error de la sesión.
    if(isset($_SESSION['error'])){
        $oError=$_SESSION['error'];
        $avError=[
            'codError'=>$oError->getCodError(),
            'descError'=>$oError->getDescError(),
            'archivoError'=>$oError->getArchivoError(),
            'lineaError'=>$oError->getLineaError(),
            'paginaSiguiente'=>$oError->getPaginaSiguiente()
        ];
        unset($_SESSION['error']);
    }

    if(isset($_REQUEST['volver'])){
        // Si se pulsa le damos el valor de la página solicitada a la variable $_SESSION.
        $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
        header('Location: indexLoginLogoff.php');
        exit;
    }

    require_once $view['layout'];
?>