<?php
    // Si se intenta acceder a la página sin iniciar sesión resirige a la Inicio publico.
    if(empty($_SESSION['usuarioDAW202LoginLogoff'])) {
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Redirige a la página de inicio.
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
        header("location: index.php");  
        exit;
    }

    // Codigo que se ejecuta si pulsamos el botón volver
    if (isset($_REQUEST['volverMostrar'])) {
        $_SESSION['paginaEnCurso'] = 'departamento';
        header("location: index.php");
        exit;
    }

    // Código que se ejecuta al pulsar cerrar sesión
    if(isset($_REQUEST['cerrarSesion'])){
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso']='inicioPublico';
        header("location: index.php");  
        exit;
    }

    define("OBLIGATORIO",1);
    $entradaOK=true;

    $aErrores=[
        'CodDepartamento' => null,
        'DescDepartamento' => null,
        'VolumenNegocio' => null
    ];

    $aRespuestas=[
        'CodDepartamento' => null,
        'DescDepartamento' => null,
        'VolumenNegocio' => null
    ];

    if(isset($_REQUEST['crearDep'])){
        $aErrores['CodDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['CodDepartamento'], 3, 3, OBLIGATORIO);
        $aErrores['DescDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescDepartamento'], 255, 1, OBLIGATORIO);
        $aErrores['VolumenNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['VolumenNegocio'], PHP_FLOAT_MAX, PHP_FLOAT_MIN, OBLIGATORIO);

        if($aErrores['CodDepartamento']==null){
            if(!ctype_upper($_REQUEST['CodDepartamento'])){
                $aErrores['CodDepartamento'] = "El codigo de departamento debe introducirse en letras mayusculas";
            }else{
                if(DepartamentoPDO::buscarDepartamentoPorCod($_REQUEST['CodDepartamento']) != null){
                    $aErrores['CodDepartamento'] = "El codigo de departamento introducido ya se encuentra registrado";
                }
            }
        }

        // Recorremos el array de errores
        foreach ($aErrores as $campo => $error){
            if ($error != null) { // Comprobamos que el campo no esté vacio
                $entradaOK = false; // En caso de que haya algún error le asignamos a entradaOK el valor false para que vuelva a rellenar el formulario      
                $_REQUEST[$campo] = "";
            }
        }
    }else{
        $entradaOK=false;
    }

    if($entradaOK){
        DepartamentoPDO::altaDepartamento($_REQUEST['CodDepartamento'], $_REQUEST['DescDepartamento'], $_REQUEST['VolumenNegocio']);
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'departamento';
        header('Location: index.php');
        exit;
    }

    // Cargamos el layout principal
    require_once $view['layout'];
?>