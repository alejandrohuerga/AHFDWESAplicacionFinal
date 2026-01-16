<?php 


class DBPDO{  // Clase para la conexión con la base de datos y poder ejecutar consultas.
    public static function ejecutarConsulta ($entradaSQL, $parametros=null){  //MÉtodo que se llama ejecutar consulta y le pueda pasar una cosnulta y unos parametros.
        try{
            $miDB=new PDO(DNS,USUARIODB,PSWD); // Instanciamos un objeto PDO y establecemos la conexión.
            $miDB -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Fórmula que utilizara cuando se porduzca un error en la consulta.
            $consulta =$miDB->prepare($entradaSQL); // Preparación de la consulta que se le ha pasado como parámetro.
            $consulta->execute($parametros); // Ejecución de la consulta con los parámetros pasados.

        }catch (PDOException $exc) {
            $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
            $_SESSION['paginaEnCurso'] = 'error';

            $_SESSION['error'] = new AppError(
                $exc -> getCode(),
                $exc -> getMessage(),
                $exc -> getFile(),
                $exc -> getLine(),
                $_SESSION['paginaAnterior']

            );

            header('Location: indexLoginLogoff.php');
            exit;
        }

        return $consulta; // Devolvemos la consulta.
    }
}

?>