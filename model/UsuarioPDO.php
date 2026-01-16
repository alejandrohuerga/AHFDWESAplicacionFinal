<?php
require_once 'model/DBPDO.php'; // Importamos la clase DBPDO.
require_once 'model/Usuario.php'; // Importamos la clase Usuario.php.
/**
 * Clase UsuarioPDO
 * 
 * Clase para las funciones del usuario.
 * 
 * @author Alejandro De la Huerga Fernández
 * @version 1.0.0 Última modificación: 18/12/2025
 *  
 * */

class UsuarioPDO{
    
    /**
     * Función para validar un usuario.
     * Función que comprueba si existe el usuario en la base de datos.
     * Parámetros: Código y Password.
     * 
     * @param String $codUsuario , código del usuario a validar.
     * @param String $password , password sin codificar y sin unir el código del usuario.
     * @return Objeto usuario|null|PDOException.
     * Devuelve un objeto Usuario si existe.
     * Devuelve null si no ha encontrado al usuario.
     * Devuelve PDOException si ha habido algún error.
     * 
     * @author Alejandro De la Huerga.
     * @version 1.0.0 Fecha Última modificación: 18/12/2025.
     * @since 03/01/2025
     */
    
    public static function validarUsuario($codUsuario,$password){
        $oUsuario = null; // inicializo la variable que tendrá el objeto de clase usuario en el caso de que se encuentre en la base de datos

        $sentenciaSQL = "Select * from T_01Usuario where T01_CodUsuario=? and T01_Password=?";
        $passwordEncriptado=hash("sha256", ($codUsuario.$password)); // enctripta el password pasado como parametro
        $resultadoConsulta = DBPDO::ejecutarConsulta($sentenciaSQL, [$codUsuario,$passwordEncriptado]); // guardo en la variable resultado el resultado que me devuelve la funcion que ejecuta la consulta con los paramtros pasados por parmetro
        
        if($resultadoConsulta->rowCount()>0){ // si la consulta me devuelve algun resultado
            $oRegistroUsuario = $resultadoConsulta->fetchObject(); // guardo en la variable el resultado de la consulta en forma de objeto.
            $oUsuario = new Usuario(
                $oRegistroUsuario->T01_CodUsuario, 
                $oRegistroUsuario->T01_Password, 
                $oRegistroUsuario->T01_DescUsuario, 
                $oRegistroUsuario->T01_NumConexiones, 
                $oRegistroUsuario->T01_FechaHoraUltimaConexion,
                $oRegistroUsuario -> T01_FechaHoraUltimaConexionAnterior = null,
                $oRegistroUsuario->T01_Perfil, 
                $oRegistroUsuario->T01_ImagenUsuario
            ); 
            self::registrarUltimaConexion($oUsuario); // Actualizamos la última conexión.
        }
        return $oUsuario;    
    }

    /**
     * Función para guardar la última conexión del usuario.
     * Método que registra la fecha y la hora de la última conexión del usuario.
     * 
     * @param String $codUsuario código del usuario.
     * @return null|Usuario con los campos actualizados.
     * 
     * @author Alejandro De la Huerga.
     * @version 1.0.0 Fecha Última modificación: 04/12/2025.
     * @since 04/01/2025
     */

    public static function registrarUltimaConexion ($oUsuario){
        
        $codUsuario = $oUsuario->getCodUsuario();
        // Actualizamos número de conexiones y fecha/hora
        $sentenciaUpdate = "UPDATE T_01Usuario SET T01_NumConexiones = T01_NumConexiones + 1, T01_FechaHoraUltimaConexion = NOW() WHERE T01_CodUsuario = ?";
        $resultadoUpdate = DBPDO::ejecutarConsulta($sentenciaUpdate, [$codUsuario]);
        // Actualizamos el objeto usuario.
        // Cambiamos la fecha que tenia de última conexion por la de ahora.
        $oUsuario->setFechaHoraUltimaConexionAnterior($oUsuario->getFechaHoraUltimaConexion());
        $oUsuario->setNumAccesos($oUsuario->getNumAccesos()+1);

        // Establecer la nueva fecha de conexión (ahora)
        date_default_timezone_set('Europe/Madrid');
        $oUsuario->setFechaHoraUltimaConexion(new DateTime());  
    }
}
?>