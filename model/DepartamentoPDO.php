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
         * @return Objeto Departemento|null|PDOException.
         * Devuelve un objeto Departamento si existe.
         * Devuelve null si no ha encontrado al departamento.
         * Devuelve PDOException si ha habido algún error.
         * 
         * @author Alejandro De la Huerga.
         * @version 1.0.0 Fecha Última modificación: 23/01/2026.
         * @since 23/01/2025
         */

        public static function buscaDepartamentoPorCod($codDepartamento){

            $aDepartamentos=[]; //Array que almacena los objetos Departamento que se encuentren.

            // Consulta para buscar departamentos por el código.
            $consulta ="SELECT * FROM T_02Departamento WHERE T02_CodDepartamento LIKE '%$codDepartamento%';";
            $resultadoConsulta=DBPDO::ejecutarConsulta($consulta,$codDepartamento);

            if($resultadoConsulta ->rowCount()>0){ // Si la consulta nos devuelve algún resultado.
                $oBusquedaDepartamento=$resultadoConsulta->fetchObject();

                $oDepartamento= new Departamento(
                    $oBusquedaDepartamento -> T02_CodDepartamento,
                    $oBusquedaDepartamento -> T02_DescDepartamento,
                    $oBusquedaDepartamento -> T02_FechaCreacionDepartamento,
                    $oBusquedaDepartamento -> T02_VolumenDeNegocio,
                    $oBusquedaDepartamento -> T02_FechaBajaDepartamento
                );

            }

            return $oDepartamento;
        }
    }
?>