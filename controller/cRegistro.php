<?php 
    /**
     * @author Alejandro De la Huerga.
     * @since 26/01/2026
     * @version 1.0.0
     */

    if(isset($_REQUEST['cancelar'])){
        $_SESSION['paginaEnCurso'] = 'login';
        header('Location: index.php');
        exit;
    }

    $aErrores=[
        'usuario' => '',
        'password' => '',
        'confirmarPassword' => '',
        'descripcion' => ''
    ];

    $aRespuestas=[
        'usuario' => '',
        'password' => '',
        'confirmarPassword' => '',
        'descripcion' => ''
    ];

    $entradaOK = true;

    if(isset($_REQUEST['enviar'])){
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];

        // Validamos todos los campos del formulario.
        $aErrores['usuario'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['usuario'], 8, 4, 1);
        $aErrores['password'] = validacionFormularios::validarPassword($_REQUEST['password'], 8, 4, 1, 1);
        $aErrores['confirmarPassword'] = validacionFormularios::validarPassword($_REQUEST['confirmarPassword'], 8, 4, 1, 1);
        $aErrores['descripcion'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['descripcion'], 255, 4, 1);
        
        if($_REQUEST['password'] !== $_REQUEST['confirmarPassword']){
            $aErrores['confirmarPassword'] = "Las contraseñas deben coincidir";
            $entradaOK=false;
        }

        // Guardamos las respuestas para mostrarlas en case de algun campo fallido.
        $aRespuestas['usuario'] = $_REQUEST['usuario'];
        $aRespuestas['password'] = $_REQUEST['password'];
        $aRespuestas['confirmarPassword'] = $_REQUEST['confirmarPassword'];
        $aRespuestas['descripcion'] = $_REQUEST['descripcion'];

        // Verificar si hay errores de validación
        foreach ($aErrores as $valorCampo => $msjError) {
            if ($msjError != null) {
                $entradaOK = false;
            }
        }

        // Si la validación es correcta, validar con la BD
        if ($entradaOK) {
            // Se comprueba si el código de usuario ya existe
            if (UsuarioPDO::validarCodNoExiste($_REQUEST['usuario'])) {
                $aErrores['usuario'] = "El nombre de usuario ya existe.";
                $entradaOK = false;
            if ($_REQUEST['password'] !== $_REQUEST['confirmarPassword']) {
                $aErrores['confirmarPassword'] = "Las nuevas contraseñas no coinciden.";
                $entradaOK = false;
            } 
            } else {
                // Si no existe, se crea el nuevo usuario
                $oUsuario = UsuarioPDO::altaUsuario(
                    $_REQUEST['usuario'],
                    $_REQUEST['password'],
                    $_REQUEST['descripcion']
                );

                if ($oUsuario === null) {
                    $entradaOK = false;
                    //Se crea el error en el caso de que no se pueda crear el usuario
                    $_SESSION['errorRegistro'] = "Error al crear el usuario. Por favor, inténtalo de nuevo.";
                    //Se redirige al login 
                    $_SESSION['paginaEnCurso'] = 'login';
                    header('Location: index.php');
                    exit;
                    unset($_SESSION['usuarioDAW202LoginLogoff']);
                    $_SESSION['usuarioDAW202LoginLogoff'] = $oUsuario;
                } else {
                    // Login correcto
                    $_SESSION['usuarioAHFDAW202LoginLogoff'] =$oUsuario;
                    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
                    header('Location: index.php');
                    exit;
                }
                
            }
        }
    }else{
        $entradaOK = false;
    }

    require_once $view['layout'];
?>

