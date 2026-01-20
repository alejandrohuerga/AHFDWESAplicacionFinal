<?php
/**
 * @author Alejandro De la Huerga Fernández
 * @since 16/12/2025
*/
    // Importamos todo el modelo para no tener que importarlos por los archivos.
    require_once 'model/Usuario.php';
    require_once 'model/UsuarioPDO.php';
    require_once 'model/AppError.php';
    require_once 'model/DBPDO.php';
    require_once 'model/REST.php';
    require_once 'model/FotoNasa.php';
    require_once 'core/231018libreriaValidacion.php';
    require_once 'model/Pokemon.php';

    $controller = [
        'inicioPublico' => 'controller/cInicioPublico.php',
        'login' => 'controller/cLogin.php',
        'inicioPrivado' => 'controller/cInicioPrivado.php',
        'detalle' => 'controller/cDetalle.php',
        'departamento' => 'controller/cWip.php',
        'error' => 'controller/cError.php',
        'api'=>'controller/cREST.php'
    ];

    $view = [
        'inicioPublico' => 'view/vInicioPublico.php',
        'layout' => 'view/layout.php',
        'login' => 'view/vLogin.php',
        'inicioPrivado' => 'view/vInicioPrivado.php',
        'detalle' => 'view/vDetalle.php',
        'departamento' => 'view/vWip.php',
        'error' => 'view/vError.php',
        'api' => 'view/vREST.php'
    ];
?>