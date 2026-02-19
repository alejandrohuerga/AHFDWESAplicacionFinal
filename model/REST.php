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
            $url = "https://api.nasa.gov/planetary/apod?api_key=" . API_KEY_NASA . "&date=$fecha";

            // Inicializar cURL
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_CONNECTTIMEOUT => 10,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) PHP-App'
            ]);

            $resultado = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($resultado === false || $httpCode !== 200) {
                return null;
            }

            $archivoApi = json_decode($resultado, true);
            if (!isset($archivoApi['title'], $archivoApi['media_type'])) {
                return null;
            }

            // Solo procesamos si es imagen
            if ($archivoApi['media_type'] !== 'image') {
                return "NoHayImagen";
            }

            // Descargar imagen en binario
            $imagenBase64 = "";
            if (!empty($archivoApi['url'])) {
                $chImg = curl_init();
                curl_setopt_array($chImg, [
                    CURLOPT_URL => $archivoApi['url'],
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => true
                ]);
                $binario = curl_exec($chImg);
                curl_close($chImg);

                if ($binario) {
                    $imagenBase64 = 'data:image/jpeg;base64,' . base64_encode($binario);
                }
            }

            // Descargar imagen HD si existe
            $imagenBase64HD = "";
            if (!empty($archivoApi['hdurl'])) {
                $chImgHD = curl_init();
                curl_setopt_array($chImgHD, [
                    CURLOPT_URL => $archivoApi['hdurl'],
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => true
                ]);
                $binarioHD = curl_exec($chImgHD);
                curl_close($chImgHD);

                if ($binarioHD) {
                    $imagenBase64HD = 'data:image/jpeg;base64,' . base64_encode($binarioHD);
                }
            }

            // Crear objeto FotoNasa
            $fotoNasa = new FotoNasa(
                $archivoApi['title'],
                $archivoApi['explanation'] ?? '',
                $archivoApi['hdurl'] ?? '',
                $archivoApi['media_type'] ?? '',
                $archivoApi['service_version'] ?? '',
                $archivoApi['url'],
                $archivoApi['date']
            );

            return $fotoNasa;
        }
    }
    
?>