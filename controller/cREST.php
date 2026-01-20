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

    $aErrores = [
        'fechaNasa' => null
    ];

    $oFotoNasa = null;

    // Obtenemos la fecha de hoy para valores por defecto.
    $fechaHoy=new DateTime();
    $fechaHoyFormateada=$fechaHoy -> format('Y-m-d');
    $fechaNasa = $fechaHoyFormateada;

    // Validación al darle al botón enviar de la Nasa
    if(isset($_REQUEST['enviar'])){
        $entradaOK = true;
        $aErrores['fechaNasa'] = validacionFormularios::validarFecha($_REQUEST['fechaNasa'], $fechaHoyFormateada, '1995-06-16', 1);

        if ($aErrores['fechaNasa'] != null) {
            $entradaOK = false;
        }

        if ($entradaOK) {
            $fechaNasa = $_REQUEST['fechaNasa'];
        }
    }

    $oFotoNasa=REST::apiNasa($fechaNasa);

    $avRestNasa =[
        'tituloNasa' => ($oFotoNasa) ? $oFotoNasa->getTitulo() : "No hay datos",
        'fotoNasa' => ($oFotoNasa) ? $oFotoNasa->getFoto() : "",
        'fechaNasa' => $fechaNasa,
        'explicacionNasa' => ($oFotoNasa) ? $oFotoNasa->getExplicacion() : "",
        'errorNasa' => $aErrores['fechaNasa'],
    ];

    // Controlador de la Api de Pokemon.

    $aErroresPokemon=[
        'nombrePokemon' => null
    ];

    $aRespuestasPokemon =[
        'nombrePokemon' => null
    ];
    $entradaOk = false;
    $nombrePokemon = $_REQUEST['pokemonNombre'] ?? 'Bulbasaur';

    $oPokemon = new Pokemon ("Bulbasaur","https://raw.githubusercontent.com/Pokemon-3D-api/assets/refs/heads/main/models/opt/regular/1.glb","shiny");

    // Si se envia el formulario.
    if(isset($_REQUEST['enviarPokemon'])){
        $entradaOk = true;

        //Validación del campo de entrada.
        $aErroresPokemon['nombrePokemon'] = validacionFormularios::comprobarAlfabetico($nombrePokemon,1000,1);

        if($aErroresPokemon['nombrePokemon'] != null){
            $entradaOk= false;
        }else{
            $aRespuestasPokemon['nombrePokemon'] = $_REQUEST['pokemonNombre'];
            $nombrePokemon = $_REQUEST['pokemonNombre'];
        }
    }
    
    // Si el nombre esta bien.
    if($entradaOk){
        // Llamamos a la Api.
        $oPokemon = REST::apiPokemon3DPorNombre($nombrePokemon);
    }

    //Preparaos el array para la vista.
    $avRestPokemon = [
        'nombrePokemon' => ($oPokemon) ? $oPokemon -> getNombre(): "No hay datos",
        'modelo3D' => ($oPokemon) ? $oPokemon -> getModelo3D(): "",
        'forma' => ($oPokemon) ? $oPokemon ->getForma(): "",
        'errorPokemon' => $aErroresPokemon['nombrePokemon'],
    ];

    require_once $view['layout'];
?>