<?php 
    /**
     * Clase que representa un Departamento , permitiendonos instanciar objetos.
     * 
     * @author Alejandro De la Huerga.
     * @since 23/01/2026
     * @version 1.0.0
     */

    class Departamento{
        private $codDepartamento;
        private $descDepartamento;
        private $fechaCreacionDepartamento;
        private $volumenNegocio;
        private $fechaBajaDepartamento;

        /**
         * Function __construct
         * Función constructor para crear un objeto usuario.
         * 
         * @param String $codDepartamento Cadena del codigo de departamento, max length=8.
         * @param String $descDepartamento Cadena de la descripción de departamento, max length=64.
         * @param String $fechaCreacionDepartamento Cadena con la fecha de creacion de un departamento, max length=255.
         * @param float $volumenNegocio Volumen de negocio del departamento.
         * @param String $fechaBajaDepartamento Fecha en la que se dio de naja el departamento.
         */

        public function __construct($codDepartamento,$descDepartamento,$fechaCreacionDepartamento,$volumenNegocio,$fechaBajaDepartamento) {
            $this ->codDepartamento=$codDepartamento;
            $this->descDepartamento=$descDepartamento;
            $this->fechaCreacionDepartamento=$fechaCreacionDepartamento;
            $this -> volumenNegocio = $volumenNegocio;
            $this -> fechaBajaDepartamento = $fechaBajaDepartamento;
        }

        /**
         * Get the value of codDepartamento
         */
        public function getCodDepartamento()
        {
                return $this->codDepartamento;
        }

        /**
         * Get the value of descDepartamento
         */
        public function getDescDepartamento()
        {
                return $this->descDepartamento;
        }

        /**
         * Get the value of fechaCreacionDepartamento
         */
        public function getFechaCreacionDepartamento()
        {
                return $this->fechaCreacionDepartamento;
        } 

        /**
         * Get the value of volumenNegocio
         */
        public function getVolumenNegocio()
        {
                return $this->volumenNegocio;
        } 

        /**
         * Get the value of fechaBajaDepartamento
         */
        public function getFechaBajaDepartamento()
        {
                return $this->fechaBajaDepartamento;
        }


        /**
         * Set the value of fechaBajaDepartamento
         */
        public function setFechaBajaDepartamento($fechaBajaDepartamento): self
        {
                $this->fechaBajaDepartamento = $fechaBajaDepartamento;

                return $this;
        }
    }

?>