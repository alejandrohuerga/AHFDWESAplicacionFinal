<?php 
/**
 * @author Alejandro De la Huerga
 * @since 16/12/2025
 */
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alejandro De la Huerga - LoginLogoff</title>
    <link rel="stylesheet" href="webroot/css/estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bitcount+Grid+Double:wght@100..900&family=Play:wght@400;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php require_once $view[$_SESSION['paginaEnCurso']];?>
    <footer>
        <p class="nombre"><a href="https://alejandrohuefer.ieslossauces.es/">Alejandro De la Huerga Fernández</a><p>
        <p class="webImitada"><a href="https://www.faceit.com/es" target="_blank">Página Web imitada</a><p>
        <p class="webImitada"><a href="/webroot/images/Curriculum.pdf" target="_blank">Curriculum</a><p>
        <a href="https://github.com/alejandrohuerga/AHFDWESLoginLogoff.git" target="_blank">
            <img src="webroot/images/icone-github-grise.png"> 
        </a>
    </footer>
</body>
</html>