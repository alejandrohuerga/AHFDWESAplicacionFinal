<?php 

    // Si se intenta acceder a la página sin iniciar sesión redirige al Inicio público.
    if(empty($_SESSION['usuarioDAW202LoginLogoff'])) {
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
        header("location: index.php");  
        exit;
    }

    // Código que se ejecuta al pulsar el botón volver.
    if(isset($_REQUEST['volver'])){
        $_SESSION['paginaEnCurso']='departamento';
        header("location: index.php");  
        exit;
    }

    $oDepartamento = DepartamentoPDO::buscarDepartamentoPorCod($_SESSION['codDepartamentoEnCurso']);
    $avDepartamentoBorrar =[];

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

    if(isset($_REQUEST['eliminarDep'])){
        DepartamentoPDO::bajaFisicaDepartamento($_SESSION['codDepartamentoEnCurso']);
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'departamento';
        header('Location: index.php');
        exit;
    }

    // Cargamos el layout principal
    require_once $view['layout'];
?>