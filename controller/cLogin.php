<?php
    // Si se pulsa el botón de registro , vamos a dar de alta un usuario.
    /*
    if(isset($_REQUEST['registrarse'])){
        $_SESSION['paginaEnCurso'] = 'registro';
        header('Location: index.php');
        exit;
    }
    */
    // Si pulsa el boton volver , volvemos a la pagina anterior.
    if (isset($_REQUEST["cancelar"])) {
        $_SESSION['paginaEnCurso']='inicioPublico';
        header("Location: index.php");  
        exit;
    }

    // Arrays para errores y respuestas , llamarlos como en la base de datos. (T01_CodUsuario,T01_Password).
    $aErrores = [
        'usuario' => null,
        'password' => null
    ];

    $aRespuestas = [
        'usuario' => '',
        'password' => ''
    ];

    // Variable para controlar si la entrada es correcta
    $entradaOK = true;

    // Variable objeto de usuario inicializado a null.
    $oUsuario=null;

    // Si pulsa iniciar Sesión, entramos en Inicio privado.
    if (isset($_REQUEST["entrar"])) {
        // Guardar página anterior
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        
        // Validar los campos del formulario
        $aErrores['usuario'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['usuario'], 255, 0, 0);
        $aErrores['password'] = validacionFormularios::validarPassword($_REQUEST['password'], 20, 2, 1, 1);
        
        // Guardar las respuestas para rellenar el formulario si hay algun error
        $aRespuestas['usuario'] = $_REQUEST['usuario'];
        $aRespuestas['password'] = $_REQUEST['password'];
        
        // Verificar si hay errores de validación
        foreach ($aErrores as $valorCampo=>$msjError) {
            if ($msjError !=null) {
                $entradaOK = false;
            }
        }
        
        if($entradaOK){
            $oUsuario=UsuarioPDO::validarUsuario($aRespuestas['usuario'],$aRespuestas['password']);
            if(!isset($oUsuario)){
                $entradaOK=false;
            }
        }
        
    }else {
        // Si no se ha enviado el formulario
        $entradaOK = false;
    }

    // Si la validación es correcta, validar con la BD
    if ($entradaOK) {
        // Login correcto
        $_SESSION['usuarioDAW202LoginLogoff'] = $oUsuario;
        UsuarioPDO::registrarUltimaConexion($_SESSION['usuarioDAW202LoginLogoff']);
        $_SESSION['paginaEnCurso'] = 'inicioPrivado';
        header('Location: index.php');
        exit;
    }

    // cargamos el layout principal, y cargará cada página a parte de la estructura principal de la web
    require_once $view['layout'];
?>