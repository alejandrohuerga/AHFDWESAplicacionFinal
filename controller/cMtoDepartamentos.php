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

    $aErrores =[
        'CodDepartamentoBuscar' => ''
    ];

    $aDepartamentos=[]; // Array que almacena los objetos Departamento para pasarlos a la vista.

    // Inicializamos el array con todos los departamentos.
    $aDepartamentos=DepartamentoPDO::buscarTodosDepartamentos();

    define('OBLIGATORIO', 0);

    $entradaOK=true;
    $oDepartamento=null;

    if(isset($_REQUEST['codBuscado'])){
        $aErrores['CodDepartamentoBuscar'] =validacionFormularios::comprobarAlfabetico($_REQUEST['CodDepBuscado'],3,3,OBLIGATORIO);
        
        if($aErrores['CodDepartamentoBuscar'] != null){
            $entradaOK = false;
        }

        if($entradaOK){
            $aDepartamentos=DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['CodDepBuscado']);
            
            if(empty($aDepartamentos)){
                $aDepartamentos=DepartamentoPDO::buscarTodosDepartamentos();
            }
        }
    }
    
    // Cargamos el layout principal que cargara cada página a parte de la estructura principal.
    require_once $view['layout'];
?>