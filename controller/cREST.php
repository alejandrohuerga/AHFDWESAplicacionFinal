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
        header("location: indexLoginLogoff.php");  
        exit;
    }

    // Código que se ejecuta al pulsar el botón volver.
    if(isset($_REQUEST['volver'])){
        $_SESSION['paginaEnCurso']='inicioPrivado';
        header("location: indexLoginLogoff.php");  
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

    $aErroresNasa=[
        'fechaFoto' =>''
    ];

    $aRespuestasNasa=[
        'fechaFoto' => null
    ];

    $entradaOK=true;

    $fechaMaxima=new DateTime('Y-m-d');
    

    if(isset($_REQUEST['enviar'])){ // Código que se ejecuta cuando se envia el formulario.
        $aErroresNasa['fechaFoto']=validacionFormularios::validarFecha($fechaMaxima,"01/01/1900",1);

        // Si en el array de errores encuentra un error $entradaOK pasa a un valor falso.
        foreach($aErroresNasa as $campo => $valor){
            if($valor != null){ // Si ha habido algun error $entradaOK es falso.
                $entradaOK=false;
            }else{
                $aRespuestasNasa[$campo]=$_REQUEST[$campo];
            }
        }
    }else{
        $entradaOK=false; // Si el formulario no se ha rellando nunca.
    }

    if($entradaOK){
        $aRespuestasNasa['fechaFoto']=$_REQUEST['fechaNasa'];
    }
    
    require_once $view['layout'];
?>