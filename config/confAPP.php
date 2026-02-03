<?php
/**
 * @author Alejandro De la Huerga Fernández
 * @since 16/12/2025
*/
    date_default_timezone_set('Europe/Madrid');

    // ApiKey de la Api de la Nasa de foto del dia.
    define("API_KEY_NASA","6qXdzrHPJ6rIaOMcGJDAePcNlUMFoAtOdcjy8yZg");

    // Importamos todo el modelo para no tener que importarlos por los archivos.
    require_once 'model/Usuario.php';
    require_once 'model/UsuarioPDO.php';
    require_once 'model/AppError.php';
    require_once 'model/DBPDO.php';
    require_once 'model/REST.php';
    require_once 'model/FotoNasa.php';
    require_once 'core/231018libreriaValidacion.php';
    require_once 'model/Pokemon.php';
    require_once 'model/Departamento.php';
    require_once 'model/DepartamentoPDO.php';

    define("PREGUNTASEG",'pimentel');

    $controller = [
        'inicioPublico' => 'controller/cInicioPublico.php',
        'login' => 'controller/cLogin.php',
        'inicioPrivado' => 'controller/cInicioPrivado.php',
        'detalle' => 'controller/cDetalle.php',
        'departamento' => 'controller/cMtoDepartamentos.php',
        'wip' => 'controller/cWip.php',
        'error' => 'controller/cError.php',
        'api'=>'controller/cREST.php',
        'registro' => 'controller/cRegistro.php',
        'consultarModificarDepartamento' => 'controller/cConsultarModificarDepartamento.php'
    ];

    $view = [
        'inicioPublico' => 'view/vInicioPublico.php',
        'layout' => 'view/layout.php',
        'login' => 'view/vLogin.php',
        'inicioPrivado' => 'view/vInicioPrivado.php',
        'detalle' => 'view/vDetalle.php',
        'departamento' => 'view/vMtoDepartamentos.php',
        'wip' => 'view/vWip.php',
        'error' => 'view/vError.php',
        'api' => 'view/vREST.php',
        'registro' => 'view/vRegistro.php',
        'consultarModificarDepartamento' => 'view/vConsultarModificarDepartamento.php'
    ];

    // Array que controla los diferentes perfiles de los usuarios para funcionalidad.
    $aPermisos=[
        'pagDetalle' => ['administrador','usuario'],
        'pagError' => ['administrador','usuario'],
        'pagRest' => ['administrador','usuario'],
        'mtoDepartamentos' => ['administrador','usuario'],
        'mtoUsuarios' => ['administrador'],
    ];
?>