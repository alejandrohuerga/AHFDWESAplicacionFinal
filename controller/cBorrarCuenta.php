<?php 
    // Si se intenta acceder a la página sin iniciar sesión resirige a la Inicio publico.
    if(empty($_SESSION['usuarioDAW202LoginLogoff'])) {
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Redirige a la página de inicio.
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
        header("location: index.php");  
        exit;
    }

    // CÓDIGO QUE SE EJECUTA AL PULSAR EL BOTÓN CANCELAR.
    if(isset($_REQUEST['cancelar'])){
        $_SESSION['paginaEnCurso'] = 'inicioPrivado';
        header('Location: index.php');
        exit;
    }

    // Array que almacena los datos del Usuario en curso para mostrarlos en el formulario.
    $avUsuario=[
        'codUsuario' => $_SESSION['usuarioDAW202LoginLogoff'] -> getCodUsuario(),
        'descUsuario' => $_SESSION['usuarioDAW202LoginLogoff'] -> getDescUsuario(),
        'numConexiones' => $_SESSION['usuarioDAW202LoginLogoff'] -> getNumAccesos(),
        'fechaHoraUltimaConexion' => $_SESSION['usuarioDAW202LoginLogoff'] ->getFechaHoraUltimaConexion() -> format('d/m/Y'),
        'imagenUsuario' => $_SESSION['usuarioDAW202LoginLogoff'] -> getImagenUsuario()
    ];

    define("OBLIGATORIO",1);

    $entradaOK=true;

    $errorPassword=null;

    if(isset($_REQUEST['borrarCuentaPagina'])){
        $errorPassword=validacionFormularios::validarPassword($_REQUEST['Password'], 8, 1 ,1, OBLIGATORIO);

        if($errorPassword!=null){
            $entragaOK=false;
        }

        if($entradaOK){
            $passwordEncriptada = hash("sha256", ($avUsuario['codUsuario'].$_REQUEST['Password']));
            if($passwordEncriptada!=$_SESSION['usuarioDAW202LoginLogoff'] -> getPassword()){
                $errorPassword="Password erronea";
                $entradaOK=false;
            }
        }
    }else{
        $entradaOK=false;
    }

    if($entradaOK){
        UsuarioPDO::borrarUsuario($avUsuario['codUsuario']);
        session_destroy();
        header("location: index.php");  
        exit;
    }

    // Cargamos el layout principal
    require_once $view['layout'];
?>