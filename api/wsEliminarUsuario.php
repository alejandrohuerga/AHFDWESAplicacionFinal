<?php 
    /**
     * Web Service para eliminar un usuario
     * @author Alejandro 
     */

    // Importamos el modelo y librerías según tu estructura
    require_once '../model/Usuario.php';
    require_once '../model/UsuarioPDO.php';
    require_once '../core/231018libreriaValidacion.php';
    require_once '../model/DBPDO.php';
    require_once '../model/AppError.php';
    require_once '../config/confDBPDO.php';

    

    $entradaOK = true;
    $aErrores = [
        'codUsuario' => null,
        'key' => null
    ];

    $aRespuesta = [
        'resultado' => null,
        'error' => null
    ];

    

    // Validamos el parámetro del usuario a eliminar
    if (!isset($_REQUEST['codUsuario'])) {
        $aErrores['codUsuario'] = "No se ha proporcionado el código de usuario.";
        $entradaOK = false;
    } else {
        $aErrores['codUsuario'] = validacionFormularios::comprobarAlfabetico($_REQUEST['codUsuario'], 15, 3, 1);
        if ($aErrores['codUsuario'] != null) {
            $entradaOK = false;
        }
    }

    if ($entradaOK) {

        if (UsuarioPDO::borrarUsuario($_REQUEST['codUsuario'])) {
            $aRespuesta['resultado'] = 'Usuario Eliminado';
        } else {
            $aRespuesta['error'] = 'El usuario no ha podido ser eliminado de la base de datos';
        }
    } else {

        $aRespuesta['error'] = $aErrores;
    }

    // Enviamos la respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($aRespuesta, JSON_PRETTY_PRINT);
?>