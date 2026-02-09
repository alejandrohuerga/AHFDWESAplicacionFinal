<?php 
// Importamos todo el modelo para no tener que importarlos por los archivos.
    require_once '../model/Usuario.php';
    require_once '../model/UsuarioPDO.php';
    require_once '../core/231018libreriaValidacion.php';
    require_once '../model/DBPDO.php';
    require_once '../model/AppError.php';
    require_once '../config/confDBPDO.php';

    define('OBLIGATORIO',1);
    $entradaOK=true;

    $aErrores=[
        'descUsuario' => null
    ];

    $aRespuestas=[
        'descUsuario' => null
    ];

    if(isset($_REQUEST['descUsuario'])){
        $aErrores['descUsuario']=validacionFormularios::comprobarAlfabetico($_REQUEST['descUsuario'],255,0,0);

        if($aErrores['descUsuario']!=null){
            $entradaOK=false;
        }
    }
    
    if($entradaOK){
        $aRespuestas=UsuarioPDO::buscaUsuariosPorDesc($_REQUEST['descUsuario'] ?? "");
        $aUsuarios=[];

        foreach($aRespuestas as $oUsuario){
            array_push($aUsuarios,[ 
                'codUsuario' =>$oUsuario -> getCodUsuario(),
                'passwordUsuario' => $oUsuario -> getPassword(),
                'descUsuario' => $oUsuario-> getDescUsuario(),
                'fechaHoraUltimaConexion' => $oUsuario -> getFechaHoraUltimaConexion(),
                'numConexiones' => $oUsuario -> getNumAccesos(),
                'perfilUsuario' => $oUsuario -> getPerfil(),
                'imagenUsuario' =>$oUsuario ->getImagenUsuario()
            ]);
        }
    }

    header('Content-Type: application/json'); // El contenido devuelto va a tener formato JSON
    echo(json_encode($aUsuarios, JSON_PRETTY_PRINT));
?>