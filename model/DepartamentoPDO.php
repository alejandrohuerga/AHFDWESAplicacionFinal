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
         * @param String $descDepartamento , descripción del departamento a buscar.
         * @return Array $aDepartamento , array con los objetos departamento encontrados
         * Devuelve un array con los objetos departamento.
         * Devuelve PDOException si ha habido algún error.
         * 
         * @author Alejandro De la Huerga.
         * @version 1.0.0 Fecha Última modificación: 26/01/2026.
         * @since 23/01/2025
         */

        public static function buscaDepartamentoPorDesc($descDepartamento){
            $aDepartamentos=[]; //Array que almacena los objetos Departamento que se encuentren.
            
            // Consulta para buscar departamentos por el código.
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

        /**
         * Función para modificar un Departamento en la base de datos.
         * Parámetros: $codDepartamento, $descDepartamento, $volumenDepartamento.
         * 
         * @param String $codDepartamento Codigo del departamento.
         * @param String $descDepartamento , descripción del departamento a buscar.
         * @param Float $volumenDepartamento , volumen del departamento.
         * @return True | False si se ha editado o no el departamento
         * 
         * @author Alejandro De la Huerga.
         * @version 1.0.0 Fecha Última modificación: 30/01/2026.
         * @since 30/01/2025
         */

        public static function modificarDepartamento ($codDepartamento,$descDepartamento,$volumenDepartamento)
        {
            // Variable que indica si el departamento ha sido modificado.
            $departamentoModificado = false; 

            $consulta="UPDATE T_02Departamento SET T02_DescDepartamento = ?, T02_VolumenNegocio = ? WHERE T02_CodDepartamento = ?";
            $resultadoConsulta=DBPDO::ejecutarConsulta($consulta);

            if($resultadoConsulta!=null){
                $departamentoModificado = true;
            }

            return $departamentoModificado;
        }
    }
?>