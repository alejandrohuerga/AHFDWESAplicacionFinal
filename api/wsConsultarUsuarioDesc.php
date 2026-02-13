<?php 
    /**
     * Web Service buscar usuarios por descripción
     */

    require_once '../model/Usuario.php';
    require_once '../model/UsuarioPDO.php';
    require_once '../model/DBPDO.php';
    require_once '../model/AppError.php';
    require_once '../config/confDBPDO.php';

    $aRespuesta = [
        'resultado' => null,
        'error' => null
    ];

    $busqueda = $_REQUEST['descUsuario'] ?? "";


    $objetosUsuario = UsuarioPDO::buscaUsuariosPorDesc($busqueda);
    
    if ($objetosUsuario) {
        $aUsuarios = [];

        foreach ($objetosUsuario as $oUsuario) {
            array_push($aUsuarios, [
                'codUsuario' => $oUsuario->getCodUsuario(),
                'descUsuario' => $oUsuario->getDescUsuario(),
                'numConexiones' => $oUsuario->getNumAccesos(),
                'fechaHoraUltimaConexion' => $oUsuario->getFechaHoraUltimaConexion(),
                'perfilUsuario' => $oUsuario->getPerfil()
            ]);
        }
        $aRespuesta['resultado'] = $aUsuarios;
    } else {
        $aRespuesta['error'] = 'No se han encontrado usuarios.';
    }


    header('Content-Type: application/json');
    echo json_encode($aRespuesta, JSON_PRETTY_PRINT);
?>