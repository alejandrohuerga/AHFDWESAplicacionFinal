<?php 
    /**
     * @author: Alejandro De la Huerga Fernández (Adaptado)
     * @since: 03/02/2026
     */

    // Si se intenta acceder a la página sin iniciar sesión redirige al Inicio público.
    if(empty($_SESSION['usuarioDAW202LoginLogoff'])) {
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
        header("location: index.php");  
        exit;
    }
    
    // Código que se ejecuta al pulsar cerrar sesión
    if(isset($_REQUEST['cerrarSesion'])){
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso']='inicioPublico';
        header("location: index.php");  
        exit;
    }

    // Código que se ejecuta al pulsar el botón volver.
    if(isset($_REQUEST['volver'])){
        $_SESSION['paginaEnCurso']='inicioPrivado';
        header("location: index.php");  
        exit;
    }

    
    if (isset($_REQUEST['mostrar'])) {
        // Guardamos el código capturado del input hidden en la sesión
        $_SESSION['codDepartamentoEnCurso'] = $_REQUEST['codDepartamentoVer'];
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        
        $_SESSION['paginaEnCurso'] = 'consultarModificarDepartamento'; 
        header("location: index.php");
        exit;
    }

    // Código que se ejecuta el pulsar editar.
    if(isset($_REQUEST['editar'])){
        $_SESSION['codDepartamentoEnCurso'] = $_REQUEST['codDepartamentoEditar'];
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'consultarModificarDepartamento'; 
        header("location: index.php");
        exit;
    }

    // Código que se ejecuta al borrar un departamento.
    if(isset($_REQUEST['borrar'])){
        $_SESSION['codDepartamentoEnCurso']=$_REQUEST['codDepartamentoBorrar'];
        $_SESSION['paginaAnterior']=$_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = 'wip';
        header("location: index.php");
        exit;
    }

    $aErrores =[
        'DescDepartamentoBuscar' => ''
    ];

    // Array temporal para los objetos que devuelve el PDO
    $aDepartamentosObjetos = [];

    // Lógica de búsqueda y persistencia
    define('OBLIGATORIO', 0);
    $entradaOK = true;
    
    if (!isset($_SESSION['descBuscada'])) {
        $_SESSION['descBuscada'] = '';
    }

    // Si se ha pulsado buscar
    if(isset($_REQUEST['descBuscado'])){
        $aErrores['DescDepartamentoBuscar'] = validacionFormularios::comprobarAlfabetico($_REQUEST['DescDepBuscado'], 30, 1, OBLIGATORIO);
        
        if($aErrores['DescDepartamentoBuscar'] != null){
            $entradaOK = false;
        }

        if($entradaOK){  
            $aDepartamentosObjetos = DepartamentoPDO::buscaDepartamentoPorDesc($_REQUEST['DescDepBuscado']);
            $_SESSION['depBuscados'] = $aDepartamentosObjetos; 
            $_SESSION['descBuscada'] = $_REQUEST['DescDepBuscado'];
        } 
    } else {
        // Si no hay búsqueda activa, cargamos lo que había en sesión o todos por defecto
        if(isset($_SESSION['depBuscados']) && !empty($_SESSION['depBuscados'])){
            $aDepartamentosObjetos = $_SESSION['depBuscados'];
        } else {
            $aDepartamentosObjetos = DepartamentoPDO::buscarTodosDepartamentos();
        }
    }

    // --- CONVERSIÓN DE OBJETOS A ARRAY PARA LA VISTA ---
    // Este es el array que usará la vista para no tocar objetos directamente
    $aVDepartamentos = []; 

    if (!empty($aDepartamentosObjetos)) {
        foreach ($aDepartamentosObjetos as $oDepartamento) {
            $aVDepartamentos[] = [
                'codDepartamento' => $oDepartamento->getCodDepartamento(),
                'descDepartamento' => $oDepartamento->getDescDepartamento(),
                'fechaAlta' => $oDepartamento->getFechaCreacionDepartamento(),
                'volumenNegocio' => $oDepartamento->getVolumenNegocio(),
                'fechaBaja' => $oDepartamento->getFechaBajaDepartamento() ?? '—'
            ];
        }
    }
    
    $descBuscada = $_SESSION['descBuscada'];

    // Cargamos el layout principal
    require_once $view['layout'];
?>