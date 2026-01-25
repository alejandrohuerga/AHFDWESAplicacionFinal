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
         * Función para buscar un departamento por código.
         * Función que busca un departamento por el codigo.
         * Parámetros: Código.
         * 
         * @param String $codDepartamento , código del departamento a buscar.
         * @return Array $aDepartamento , array con los objetos departamento encontradffos
         * Devuelve un array con los objetos departamento.
         * Devuelve PDOException si ha habido algún error.
         * 
         * @author Alejandro De la Huerga.
         * @version 1.0.0 Fecha Última modificación: 23/01/2026.
         * @since 23/01/2025
         */

        public static function buscaDepartamentoPorCod($codDepartamento){
            $aDepartamentos=[]; //Array que almacena los objetos Departamento que se encuentren.
            
            // Consulta para buscar departamentos por el código.
            $consulta = "SELECT * FROM T_02Departamento WHERE T02_CodDepartamento LIKE ?";
            $resultadoConsulta = DBPDO::ejecutarConsulta($consulta,["%$codDepartamento%"]);

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
         * Función para buscar todos los departamentos en la base de datos.
         * Parámetros: Ninguno.
         * 
         * @return Array $aDepartamentos , array con todos los objetos
         * departamentos de la base de datos.
         * Devuelve un array con los objetos departamento que hay en la base de datos.
         * Devuelve PDOException si ha habido algún error.
         * 
         * @author Alejandro De la Huerga.
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
    }
?>