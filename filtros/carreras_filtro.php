<?php
require "./funciones_filtro.php";

$archivo_datos = fopen("../datos_malos/Carreras_bad.csv", "r");
$array_datos = [];

while (!feof($archivo_datos)) {
    $linea = fgets($archivo_datos);

    if (hay_datos($linea)) {
        $columnas = explode("|", $linea);
        
        $nombre = no_nulo($columnas[0]);

        if ($nombre) {
            $columnas_seleccionadas = [
                $nombre
            ];
            $array_datos[] = $columnas_seleccionadas;
        }
    }
}
fclose($archivo_datos); 

$array_datos_buenos = pk_unica($array_datos, 0);

$archivo_datos = fopen("../datos_aceptados/Carreras_gud.csv", "w");

$total_filas = count($array_datos_buenos);
foreach ($array_datos_buenos as $index => $dato) {
    $linea = implode(";", $dato);
    
    if ($index < $total_filas - 1) {
        fwrite($archivo_datos, trim($linea) . PHP_EOL);
    } else {
        fwrite($archivo_datos, trim($linea));
    }
}

fclose($archivo_datos);
?>