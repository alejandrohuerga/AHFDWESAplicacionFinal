<?php

    // Si se intenta acceder a la página sin iniciar sesión resirige a la Inicio publico.
    if(empty($_SESSION['usuarioDAW202LoginLogoff'])) {
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Redirige a la página de inicio.
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
        header("location: index.php");  
        exit;
    }

    // Codigo que se ejecuta si pulsamos el botón volver
    if (isset($_REQUEST['volver'])) {
        $_SESSION['paginaEnCurso'] = 'departamento';
        header("location: index.php");
        exit;
    }
    //Guardamos el objeto buscado por el codigo de departamento.
    $oDepartamento =DepartamentoPDO::buscarDepartamentoPorCod($_SESSION['codDepartamentoEnCurso']);
    
    // Array que almacena los datos del objeto departamento para pasarlos a la vista.
    $aVDepartamento = [];

    if ($oDepartamento) {
        $aVDepartamento = [
            'codDepartamento' => $oDepartamento->getCodDepartamento(),
            'descDepartamento' => $oDepartamento->getDescDepartamento(),
            'fechaAltaDepartamento' => $oDepartamento->getFechaCreacionDepartamento(),
            'volumenDepartamento' => $oDepartamento->getVolumenNegocio(),
            'fechaBajaDepartamento' => $oDepartamento->getFechaBajaDepartamento() ?? 'N/A'
        ];
    }

    // Cargamos el layout principal
    require_once $view['layout'];
?>