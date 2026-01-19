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

        public static function apiNasa($fecha){
            // Accedemos a la URL de la Nasa
            $resultado=file_get_contents("https://api.nasa.gov/planetary/apod?api_key=" . self::API_KEY_NASA);
            $archivoApi=json_decode($resultado,true);

            // Si el archivo se ha decodificado correctamente devuelve la foto.
            if(isset($archivoApi)){
                $fotoNasa=new FotoNasa($archivoApi['title'],$archivoApi['url'],$archivoApi['date']);
                return $fotoNasa;
            }
        }

        public static function apiPokemon($nombre){
            $resultadoPokemon=file_get_contents("https://pokemon-3d-api.onrender.com/v1/pokemon");
            $archivoApiPokemon=json_decode($resultadoPokemon,true);
        }
    }
?>