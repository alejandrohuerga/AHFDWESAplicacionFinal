<?php 
    /**
     * Controlador de Mantenimiento de Usuarios.
     * Este controlador esta sujeto al boton MtoUsuarios.
     * El botón solo esta disponible si el Usuario es administrador.
     * 
     * @author Alejandro De la Huerga.
     * @since 29/01/2026
     * @version 1.0.0
     * 
     */

    // Si se intenta acceder a la página sin iniciar sesión resirige a la Inicio publico.
    if(empty($_SESSION['usuarioDAW202LoginLogoff'])) {
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Redirige a la página de inicio.
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
        header("location: index.php");  
        exit;
    }

    // Si intenta entrar sin ser administrador redirige a inicio privado.
    if($_SESSION['perfilUsuario'] !== 'administrador'){
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Redirige a Inicio Privado.
        $_SESSION['paginaEnCurso']='inicioPrivado';
        header("location: index.php");
        exit;
    }

    // Código que se ejecuta al pulsar el botón volver.
    if(isset($_REQUEST['volver'])){
        $_SESSION['paginaEnCurso']='inicioPrivado';
        header("location: index.php");  
        exit;
    }

    

    // Cargamos el layout principal que cargara cada página a parte de la estructura principal.
    require_once $view['layout'];
?>