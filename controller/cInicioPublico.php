<?php 
/**
 * @author Alejandro De la Huerga
 * @since 16/12/2025
 */
  
  // Código que se ejecuta al pulsar el botón iniciar sesión
  if (isset($_REQUEST["iniciarSesion"])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso']='login';
    header("location: index.php");  
    exit;
  }

  if (!isset($_COOKIE['idioma'])) {
        setcookie("idioma", "es", time()+604.800); // caducidad 1 semana
        header('Location: index.php');
        exit;
  }
    
  if (isset($_REQUEST['idioma'])) {
    setcookie("idioma", $_REQUEST['idioma'], time()+604.800); // caducidad 1 semana
    header('Location: index.php');
    exit;
  }

  // cargamos el layout principal, y cargará cada página a parte de la estructura principal de la web
  require_once $view['layout'];
?>