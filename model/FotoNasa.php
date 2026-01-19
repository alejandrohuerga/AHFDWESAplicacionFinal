<?php 
    /**
     * Clase que representa la foto del día de la nasa con su título y URL.
     * Permite acceder a los distintos atributos de la foto.
     * 
     * @author Alejandro De la Huerga.
     * @since 18/01/2026
     * @version 1.0.0 Última actualización 18/01/2026
     */
    
    class FotoNasa{
        private $titulo;
        private $explicacion;
        private $media_type;
        private $version_servicio;
        private $foto;
        private $fecha;

        /**
         * Funcition __construct
         * Función constructor para poder crear un objeto FotoNasa.
         * 
         * @param String $título Titulo de la imagen de la nasa.
         * @param String $foto URL con la foto del día de la nasa.
         * @param String @fecha Fecha para obtener la foto de ese dia.
         * @param String @explicacion Explicación de la imagen del dia.
         * @param String @media_type Tipo de archivo multimedia que nos devuelve.
         * @param String @version_servicio Versión del servicio que nos proporciona la Nasa.
         * 
         * @since 18/01/2026
         * @author Alejandro De la Huerga.
         * @version 1.0.0
         */

        public function __construct( $titulo,  $explicacion,  $media_type,  $version_servicio,  $foto,  $fecha){
            $this->titulo = $titulo;
            $this->explicacion = $explicacion;
            $this->media_type = $media_type;
            $this->version_servicio = $version_servicio;
            $this->foto = $foto;
            $this->fecha = $fecha;
        }

        /**
         * Get the value of titulo
         */
        public function getTitulo()
        {
                return $this->titulo;
        }

        /**
         * Get the value of explicacion
         */
        public function getExplicacion()
        {
                return $this->explicacion;
        }

        /**
         * Get the value of media_type
         */
        public function getMediaType()
        {
                return $this->media_type;
        }

        /**
         * Get the value of version_servicio
         */
        public function getVersionServicio()
        {
                return $this->version_servicio;
        }

        /**
         * Get the value of foto
         */
        public function getFoto()
        {
                return $this->foto;
        }

        /**
         * Get the value of fecha
         */
        public function getFecha()
        {
                return $this->fecha;
        }
    }
?>