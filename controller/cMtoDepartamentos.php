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
        'DescDepartamentoBuscar' => ''
    ];

    // Array que almacena los objetos Departamento para pasarlos a la vista.
    $aDepartamentos=[];

    // Inicializamos el array con todos los departamentos.
    $aDepartamentos=DepartamentoPDO::buscarTodosDepartamentos();

    if(isset($_SESSION['depBuscados']) && !! !empty($_SESSION['depBuscados'])){
        $aDepartamentos = $_SESSION['depBuscados'];
    }
    define('OBLIGATORIO', 0);

    $entradaOK=true;
    $oDepartamento=null;
    $descDepartamento="";

    // Si esta vacia la inicializamos.
    if (!isset($_SESSION['descBuscada'])) {
        $_SESSION['descBuscada'] = '';
    }

    if(isset($_REQUEST['descBuscado'])){
        $aErrores['DescDepartamentoBuscar'] =validacionFormularios::comprobarAlfabetico($_REQUEST['DescDepBuscado'],30,1,OBLIGATORIO);
        
        if($aErrores['DescDepartamentoBuscar'] != null){
            $entradaOK = false;
        }

        if($entradaOK){  
            $aDepartamentos=DepartamentoPDO::buscaDepartamentoPorDesc($_REQUEST['DescDepBuscado']);
            $_SESSION['depBuscados'] = $aDepartamentos; // Metemos en la sesión los departamentos encontrados.
            $_SESSION['descBuscada'] = $_REQUEST['DescDepBuscado']; // Metemos en la SESSION la descBuscada para mantenerla en el input text.
            if(empty($aDepartamentos)){
                $aDepartamentos=DepartamentoPDO::buscarTodosDepartamentos();
            }
        } 
    }
    
    $descBuscada = $_SESSION['descBuscada'];

    
    
    // Cargamos el layout principal que cargara cada página a parte de la estructura principal.
    require_once $view['layout'];
?>