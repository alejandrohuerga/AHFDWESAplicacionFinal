<?php

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
            //Se convierte la fecha en datetime
            $fechaBD = $oRegistroUsuario ->T01_FechaHoraUltimaConexion;
            $oFechaValida = ($fechaBD) ? new DateTime($fechaBD) : null;

            $oUsuario = new Usuario(
                $oRegistroUsuario->T01_CodUsuario, 
                $oRegistroUsuario->T01_Password, 
                $oRegistroUsuario->T01_DescUsuario, 
                $oRegistroUsuario->T01_NumConexiones, 
                $oFechaValida,
                null,
                $oRegistroUsuario->T01_Perfil, 
                $oRegistroUsuario->T01_ImagenUsuario
            ); 
            
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
        // Actualizamos BD
        $sentenciaUpdate = "
            UPDATE T_01Usuario 
            SET T01_NumConexiones = T01_NumConexiones + 1,
                T01_FechaHoraUltimaConexion = NOW()
            WHERE T01_CodUsuario = ?
        ";
        DBPDO::ejecutarConsulta($sentenciaUpdate, [$codUsuario]);
        // Actualizamos objeto
        $oUsuario->setNumAccesos($oUsuario->getNumAccesos() + 1);
        $oUsuario->setFechaHoraUltimaConexion(new DateTime()); 
    }

    /**
     * Función para dar de alta un Usuario.
     * Función que da de alta un nuevo usuario.
     * Parámetros: Código Password y Descripción.
     * 
     * @param String $codUsuario , código del usuario a validar.
     * @param String $password , password sin codificar y sin unir el código del usuario.
     * @param String $descUsuario , descripción del usuario.
     * @return Objeto Usuario|null.
     * Devuelve un objeto Usuario si existe.
     * Devuelve null si no ha encontrado al usuario.
     * Devuelve PDOException si ha habido algún error.
     * 
     * @author Alejandro De la Huerga.
     * @version 1.0.0 Fecha Última modificación: 18/12/2025.
     * @since 25/01/2025
     */

    public static function altaUsuario($codUsuario,$password,$descUsuario){
        $oUsuario = null;
        /**
         * SQL para insertar el nuevo registro.
         * La fecha de la ultima conexion a NOW() , momento del registro.
         * Numero de conexiones a 1 , empieza al hacer el registro.
        */
        $sql = <<<SQL
            INSERT INTO T01_Usuario 
            (T01_CodUsuario, 
            T01_Password, 
            T01_DescUsuario, 
            T01_FechaHoraUltimaConexion,
            T01_NumConexiones,
            T01_Perfil) 
            VALUES 
            (:codUsuario, 
            SHA2(:password, 256), 
            :descUsuario,
            now(),
            1,
            'usuario')
        SQL;

        try {
            $consulta = DBPDO::ejecutarConsulta($sql, [
                ':codUsuario' => $codUsuario,
                ':password' => $codUsuario . $password,
                ':descUsuario' => $descUsuario
            ]);
            
            if ($consulta) {
                $oUsuario = self::validarUsuario($codUsuario, $password);
            }
        } catch (Exception $e) {
            return null;
        }
        return $oUsuario;
    }

    /**
     * Función para validar si un codigo existe o no.
     * Parámetros: Código.
     * 
     * @param String $codUsuario , código del usuario a validar.
     * @return Objeto Usuario|null.
     * Devuelve un objeto Usuario si existe.
     * Devuelve null si no ha encontrado al usuario.
     * Devuelve PDOException si ha habido algún error.
     * 
     * @author Alejandro De la Huerga.
     * @version 1.0.0 Fecha Última modificación: 18/12/2025.
     * @since 25/01/2025
     */

    public static function validarCodNoExiste($codUsuario){
        $codExiste=false; // Inicializamos la variable a false.
        $consulta = "SELECT * FROM T_01Usuario WHERE T01_CodUsuario LIKE ?";

        try{
            /**
             * Buscamos el codigo en la base de datos.
             * Si nos devuelve alguna tupla es que ese codigo ya existe
             * $codExiste =true
             */
            $resultadoConsulta = DBPDO::ejecutarConsulta($consulta,["%$codUsuario%"]);
            if($resultadoConsulta ->rowCount()>0){ // Si hay alguna coincidencia.
                $codExiste = true; // Existe igual a true
            }
        }catch(Exception $ex){
            $codExiste=false;
        }

        return $codExiste;
    }
}
?>