<?php 
    /**
     * Clase que proporciona métodos estáticos para interactuar con Web services externos.
     * En este caso se van a utilizar los Web Services de la NASA y la AEMET.
     * 
     * @author Alejandro De la Huerga Fernández.
     * @since 18/01/2026
     * @version 1.0.0
     * 
     * Fecha última modificación: 18/01/2026
     */

    class REST{
        /**
         * Function __apiNasa(&fecha)
         * Funcion la cual conecta y hace la petición de la foto de la fecha proporcinada.
         * 
         * @param String $fecha Fecha para recibir la foto de esa fecha.
         * @return &oFotoNasa | null Devuelve una instancia del objeto FotoNasa o null.
         * 
         * @author Alejandro De la Huerga.
         * @version 1.0.0
         * @since 20/01/2026
         */

        public static function apiNasa($fecha){
            $url = "https://api.nasa.gov/planetary/apod?date=$fecha&api_key=" . API_KEY_NASA;

            if (!function_exists('curl_init')) {
                return null; // cURL no disponible
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // si hay problema con certificados
            $resultado = curl_exec($ch);
            curl_close($ch);

            if(!$resultado){
                return null;
            }

            $archivoApi = json_decode($resultado, true);
            if(!$archivoApi){
                return null;
            }

            return new FotoNasa(
                $archivoApi['title'] ?? '',
                $archivoApi['explanation'] ?? '',
                $archivoApi['urlHD'] ?? '',
                $archivoApi['media_type'] ?? '',
                $archivoApi['service_version'] ?? '',
                $archivoApi['url'] ?? '',
                $archivoApi['date'] ?? ''
            );
        }
    }
?>