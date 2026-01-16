<?php 
    /**
     * Clase AppError.php
     * 
     * Clase que representa un error producido voluntariamente.
     * Clase que nos permite crear objetos de error.
     * 
     * @author Alejandro De la Huerga.
     * @since 14/01/2026.
     * @version 1.0.0
     */

    class AppError{
        private $codError;
        private $descError;
        private $archivoError;
        private $lineaError;
        private $paginaSiguiente;

        /**
         * Function __construct
         * Función constructor para poder crear un objeto Error.
         * 
         * @param String $codError Cadena del código de error.
         * @param String $descError Cadena con la descripción del error.
         * @param String $archivoError Cadena con el archivo del error.
         * @param Integer $lineaError número de línea donde ha ocurrido el error.
         * @param String $paginaSuiguiente Cadena con la página siguiente.
         * 
         * @since 14/01/2026
         * @author Alejandro De la Huerga Fernández.
         */

        public function __construct($codError,$descError, $archivoError,$lineaError,$paginaSiguiente ){
            $this->$codError = $codError;
            $this->$descError = $descError;
            $this->$archivoError = $archivoError;
            $this->$lineaError = $lineaError;
            $this->$paginaSiguiente = $paginaSiguiente;
        }

        /**
         * Get the value of codError
         */
        public function getCodError()
        {
                return $this->codError;
        }

        /**
         * Set the value of codError
         */
        public function setCodError($codError): self
        {
                $this->codError = $codError;

                return $this;
        }

        /**
         * Get the value of descError
         */
        public function getDescError()
        {
                return $this->descError;
        }

        /**
         * Set the value of descError
         */
        public function setDescError($descError): self
        {
                $this->descError = $descError;

                return $this;
        }

        /**
         * Get the value of archivoError
         */
        public function getArchivoError()
        {
                return $this->archivoError;
        }

        /**
         * Set the value of archivoError
         */
        public function setArchivoError($archivoError): self
        {
                $this->archivoError = $archivoError;

                return $this;
        }

        /**
         * Get the value of lineaError
         */
        public function getLineaError()
        {
                return $this->lineaError;
        }

        /**
         * Set the value of lineaError
         */
        public function setLineaError($lineaError): self
        {
                $this->lineaError = $lineaError;

                return $this;
        }

        /**
         * Get the value of paginaSiguiente
         */
        public function getPaginaSiguiente()
        {
                return $this->paginaSiguiente;
        }

        /**
         * Set the value of paginaSiguiente
         */
        public function setPaginaSiguiente($paginaSiguiente): self
        {
                $this->paginaSiguiente = $paginaSiguiente;

                return $this;
        }
    }
?>