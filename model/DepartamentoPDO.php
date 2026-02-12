<?php 
    /**
     * Clase DepartamentoPDO.
     * 
     * Clase para las acciones de Departamento en la Base de Datos.
     * 
     * @author Alejandro De la Huerga.
     * @since 23/01/2026
     * @version 1.0.0
     */

    class DepartamentoPDO{
        /**
         * Función para buscar un departamento por descripción.
         * Función que busca un departamento por el cdescripción.
         * Parámetros: Descripción.
         * 
         * @param String $descDepartamento , descripción del departamento a buscar.
         * @return Array $aDepartamento , array con los objetos departamento encontrados
         * Devuelve un array con los objetos departamento.
         * Devuelve PDOException si ha habido algún error.
         *  
         * @version 1.0.0 Fecha Última modificación: 26/01/2026.
         * @since 23/01/2025
         */

        public static function buscaDepartamentoPorDesc($descDepartamento){
            $aDepartamentos=[]; //Array que almacena los objetos Departamento que se encuentren.
            
            // Consulta para buscar departamentos por el descripcion.
            $consulta = "SELECT * FROM T_02Departamento WHERE T02_DescDepartamento LIKE ?";
            $resultadoConsulta = DBPDO::ejecutarConsulta($consulta,["%$descDepartamento%"]);

            while($oRegistro = $resultadoConsulta -> fetchObject()){
                $aDepartamentos[] = new Departamento(
                    $oRegistro  -> T02_CodDepartamento,
                    $oRegistro -> T02_DescDepartamento,
                    $oRegistro -> T02_FechaCreacionDepartamento,
                    $oRegistro -> T02_VolumenDeNegocio,
                    $oRegistro -> T02_FechaBajaDepartamento
                );
            }
            
            return $aDepartamentos;
        }

        /**
         *  Función para buscar un departamento por código.
         *  Parámetros: Código de departamento.
         *  
         *  @param String $codDepartamento , código del departamento a buscar.
         *  @return null | $oDepartamento , devuelve null si no encuentra un departamento o el objeto departamento.
         *  
         *  @version 1.0.0 Fecha última modificación 03/02/2026
         *  @since 03/02/2026
        */

        public static function buscarDepartamentoPorCod($codDepartamento){
            // Objeto departamento inicializado a null.
            $oDepartamento = null; 

            $consultaSQL = "SELECT * FROM T_02Departamento WHERE T02_CodDepartamento =?";
            $resultadoConsulta = DBPDO::ejecutarConsulta($consultaSQL,[$codDepartamento]);

            if($resultadoConsulta -> rowCount() >0){
                $departamento = $resultadoConsulta ->fetchObject();

                $oDepartamento=new Departamento(
                    $departamento->T02_CodDepartamento,
                    $departamento->T02_DescDepartamento,
                    $departamento->T02_FechaCreacionDepartamento,
                    $departamento->T02_VolumenDeNegocio,
                    $departamento ->T02_FechaBajaDepartamento
                );    
            }

            return $oDepartamento;
        }

        /**
         * Función para buscar todos los departamentos en la base de datos.
         * Parámetros: Ninguno.
         * 
         * @return Array $aDepartamentos , array con todos los objetos
         * departamentos de la base de datos.
         * Devuelve un array con los objetos departamento que hay en la base de datos.
         * Devuelve PDOException si ha habido algún error.
         *  
         * @version 1.0.0 Fecha Última modificación: 25/01/2026.
         * @since 23/01/2025
         */
        
        public static function buscarTodosDepartamentos (){
            // Array para almacenar todos los objetos Departamento que hay en la base de datos.
            $aTodosDepartamentos=[];
            
            $consulta="SELECT * FROM T_02Departamento"; 
            $resultadoConsulta = DBPDO::ejecutarConsulta($consulta);

            while($oRegistro = $resultadoConsulta -> fetchObject()){
                $aTodosDepartamentos[] = new Departamento(
                    $oRegistro  -> T02_CodDepartamento,
                    $oRegistro -> T02_DescDepartamento,
                    $oRegistro -> T02_FechaCreacionDepartamento,
                    $oRegistro -> T02_VolumenDeNegocio,
                    $oRegistro -> T02_FechaBajaDepartamento
                );
            }
            
            return $aTodosDepartamentos;
        }

        /**
         * Función para dar de alta un nuevo departamento.
         * Función que da de alta un nuevo departamento en la base de datos.
         * 
         * @param String $codDepartamento código del departamento.
         * @param String $descDepartamento descripción del departamento.
         * @param Float $volumenDeNegocio volumen de negocio del departamento.
         * 
         * @version 1.0.0 Fecha última actualización 12/02/2026
         * @since 12/02/2026
         */

        public static function altaDepartamento ($codDepartamento,$descDepartamento,$volumenDeNegocio){
            $altaDepartamento=false;

            $sentenciaSQL="INSERT INTO T_02Departamento (T02_CodDepartamento,T02_DescDepartamento,T02_FechaCreacionDepartamento,T02_VolumenDeNegocio) VALUES (?,?,NOW(),?)";
            $resultadoConsulta=DBPDO::ejecutarConsulta($sentenciaSQL,[$codDepartamento,$descDepartamento,$volumenDeNegocio]);

            if($resultadoConsulta){
                $altaDepartamento=true;
            }

            return $altaDepartamento;
        }

        /**
         * Función para modificar un Departamento en la base de datos.
         * Parámetros: $codDepartamento, $descDepartamento, $volumenDepartamento.
         * 
         * @param String $codDepartamento Codigo del departamento.
         * @param String $descDepartamento , descripción del departamento a buscar.
         * @param Float $volumenDepartamento , volumen del departamento.
         * @return True | False si se ha editado o no el departamento
         * 
         * @version 1.0.0 Fecha Última modificación: 30/01/2026.
         * @since 30/01/2025
         */

        public static function modificarDepartamento ($codDepartamento,$descDepartamento,$volumenDepartamento)
        {
            // Variable que indica si el departamento ha sido modificado.
            $departamentoModificado = false; 

            $consulta="UPDATE T_02Departamento SET T02_DescDepartamento = ?, T02_VolumenDeNegocio = ? WHERE T02_CodDepartamento = ?";
            $resultadoConsulta = DBPDO::ejecutarConsulta($consulta, [
                $descDepartamento, 
                $volumenDepartamento, 
                $codDepartamento
            ]);

            if($resultadoConsulta!=null){
                $departamentoModificado = true;
            }

            return $departamentoModificado;
        }

        /**
         *  Función para eliminar un departamento de forma física.
         *  Función que elimina un departamento de la base de datos cuyo codigo es el pasado como parámetro.
         *  
         *  @param $codDepartamento Codigo del departamento.
         *  @return True | False si se ha eliminado o no el departamento.
         *  
         *  @version 1.0.0 última actualización 04/02/2026.
         *  @since 04/02/2026
         */

        public static function bajaFisicaDepartamento ($codDepartamento){
            // Variable booleana que indica si se ha eliminado o no el departamento.
            $departamentoEliminado=false;

            $consultaSQL="DELETE FROM T_02Departamento WHERE T02_CodDepartamento =?";
            $resultadoConsulta=DBPDO::ejecutarConsulta($consultaSQL,[$codDepartamento]);

            if($resultadoConsulta!=null){
                $departamentoEliminado=true;
            }

            return $departamentoEliminado;
        }

        /**
         * Función para dar de baja logica un departamento.
         * Mediante el código , se da de baja en la base de datos indicandole su fecha de baja.
         * 
         * @param String $codDepartamento Codigo del departamento.
         * @return boolean true | false dependiendo si se ha dado de baja o no.
         * 
         * @version 1.0.0
         * @since 09/02/2026
         */

        public static function bajaLogicaDepartamento ($oDepartamento){

            $sql = <<<SQL
                UPDATE T_02Departamento
                    SET T02_FechaBajaDepartamento = now()
                    WHERE T02_CodDepartamento = :codDepartamento
            SQL;
            
            try{
                $consulta = DBPDO::ejecutarConsulta($sql, [
                    ':codDepartamento' => $oDepartamento->getCodDepartamento()
                ]);
                
                if($consulta){
                    $oDepartamento->setFechaBajaDepartamento(new DateTime());
                    return $oDepartamento;
                } else{
                    return null;
                }
            } catch(Exception $ex){
                return null;
        }
            /*
            $bajaDepartamento = false;
            
            $consultaSQL="UPDATE T_02Departamento SET T02_FechaBajaDepartamento = NOW() WHERE T02_CodDepartamento=?";
            $resultadoConsulta=DBPDO::ejecutarConsulta($consultaSQL,[$codDepartamento]);

            if($resultadoConsulta!=null){
                $bajaDepartamento=true;
            }

            return $bajaDepartamento;
            */
        }

        /**
         * Función para rehabilitar un departamento.
         * Mediante el código , se rehabilita un departamento quitandole la fecha de baja en la base de datos.
         * 
         * @param String $codDepartamento Codigo del departamento.
         * @return boolean true | false dependiendo si se ha rehabilitado o no.
         * 
         * @version 1.0.0
         * @since 09/02/2026
         */

        public static function rehabilitaDepartamento($oDepartamento){
                $sql = <<<SQL
                UPDATE T_02Departamento
                    SET T02_FechaBajaDepartamento = null
                    WHERE T02_CodDepartamento = :codDepartamento
                SQL;
        
            try{
                $consulta = DBPDO::ejecutarConsulta($sql, [
                    ':codDepartamento' => $oDepartamento->getCodDepartamento()
                ]);
                
                if($consulta){
                    $oDepartamento->setFechaBajaDepartamento(null);
                    return $oDepartamento;
                } else{
                    return null;
                }
            } catch(Exception $ex){
                return null;
            }
        }
    }
?>