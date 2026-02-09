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
    if (isset($_REQUEST['volverMostrar'])) {
        $_SESSION['paginaEnCurso'] = 'departamento';
        header("location: index.php");
        exit;
    }

    // Código que se ejecuta al pulsar el botón cerrar sesión
    if(isset($_REQUEST['cerrarSesion'])){
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        // Si se pulsa le damos el valor a la página solicitada a la variable $_SESSION
        $_SESSION['paginaEnCurso']='inicioPublico';
        header("location: index.php");  
        exit;
    }

    // 1. Buscamos el departamento
    $oDepartamento = DepartamentoPDO::buscarDepartamentoPorCod($_SESSION['codDepartamentoEnCurso']);
    $aVDepartamento = [];

    // 2. Solo si existe el objeto, accedemos a sus métodos
    if ($oDepartamento instanceof Departamento) { 
        // Formateamos las fechas a datetime para sacarlo por pantalla.
        $fechaAltaDepartamento = new DateTime(($oDepartamento->getFechaCreacionDepartamento()));
        $fechaAltaFormateada =$fechaAltaDepartamento->format('d-m-Y');

        if(!is_null($oDepartamento->getFechaBajaDepartamento())){
            $fechaBajaDepartamento = new DateTime($oDepartamento->getFechaBajaDepartamento());
            $fechaBajaFormateada = $fechaAltaDepartamento->format('d-m-Y');
        }

        $volumenFormateado=(number_format($oDepartamento->getVolumenNegocio(), 2, ',', '.').'€');

        $aVDepartamento = [
            'codDepartamento' => $oDepartamento->getCodDepartamento(),
            'descDepartamento' => $oDepartamento->getDescDepartamento(),
            'fechaAltaDepartamento' => $fechaAltaFormateada,
            'volumenDepartamento' => $volumenFormateado,
            'fechaBajaDepartamento' => $fechaBajaFormateada ?? 'N/A'
        ];
    }

    // Cargamos el layout principal
    require_once $view['layout'];
?>