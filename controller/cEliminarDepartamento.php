<?php 

    // Si se intenta acceder a la página sin iniciar sesión redirige al Inicio público.
    if(empty($_SESSION['usuarioDAW202LoginLogoff'])) {
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
        header("location: index.php");  
        exit;
    }

    // Código que se ejecuta al pulsar el botón volver.
    if(isset($_REQUEST['volver'])){
        $_SESSION['paginaEnCurso']='departamento';
        header("location: index.php");  
        exit;
    }

    if(isset($_REQUEST['codDepartamentoBorrar'])){
        DepartamentoPDO::bajaFisicaDepartamento($_SESSION['']);
    }
    // Cargamos el layout principal
    require_once $view['layout'];
?>