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
        // ApiKey de la Api de la Nasa de foto del dia.
        const API_KEY_NASA = '6qXdzrHPJ6rIaOMcGJDAePcNlUMFoAtOdcjy8yZg';
        
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
            // Accedemos a la URL de la Nasa
            // El @ evita que salga el warning por pantalla
            $resultado=@file_get_contents("https://api.nasa.gov/planetary/apod?api_key=" . self::API_KEY_NASA);

            if($resultado === false){
                return null;
            }

            $archivoApi=json_decode($resultado,true);

            // Si el archivo se ha decodificado correctamente devuelve la foto.
            if(isset($archivoApi)){
                $fotoNasa=new FotoNasa(
                    $archivoApi['title'],
                    $archivoApi['explanation'] ?? '',
                    $archivoApi['media_type'] ?? '',
                    $archivoApi['service_version'] ?? '',
                    $archivoApi['url'],
                    $archivoApi['date']
                );
                return $fotoNasa;
            }

            return null;
        }

        public static function apiPokemon3DPorNombre($nombre){
            $resultadoPokemon=@file_get_contents("https://pokemon-3d-api.onrender.com/v1/pokemon");

            if($resultadoPokemon === false){
                return null;
            }

            $archivoApiPokemon=json_decode($resultadoPokemon,true);

            if(!is_array($archivoApiPokemon)){
                return null;
            }

            foreach ($archivoApiPokemon as $pokemon) {
                foreach ($pokemon['forms'] as $forma) {
                    if (strtolower($forma['name']) === strtolower($nombre)) {
                        return new Pokemon(
                            $forma['name'],
                            $forma['model'],
                            $forma['formName']
                        );
                    }
                }
            }

            return null;
        }
    }
?>