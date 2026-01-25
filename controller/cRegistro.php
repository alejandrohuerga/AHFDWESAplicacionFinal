<?php 
    /**
     * Controlador de la página de registro de usuarios.
     * 
     * @author Alejandro De la Huerga.
     * @version 1.0.0
     * @since 25/01/2026
     */

    // Si pulsa el boton volver , volvemos a la pagina anterior.
    if (isset($_REQUEST["cancelar"])) {
        $_SESSION['paginaEnCurso']='inicioPublico';
        header("location: index.php");  
        exit;
    }

    
?>