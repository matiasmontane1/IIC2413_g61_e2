<?php
require "./funciones_filtro.php";

$archivo_datos = fopen("../datos_malos/Planes_bad.csv", "r");
$array_datos = [];

while (!feof($archivo_datos)) {
    $linea = fgets($archivo_datos);

    if (hay_datos($linea)) {
        $columnas = explode("|", $linea);
        
        $codigo = strval(trim($columnas[0]));
        $nombre = no_nulo($columnas[1]);
        $inicio = fecha($columnas[2]);
        $jornada = jornada($columnas[3]);
        $modalidad = modalidad($columnas[4]);
        $sede = sede($columnas[5]);
        $grado = grado($columnas[6]);

        if ($codigo && $nombre && $inicio && $jornada && $modalidad && $sede && $grado) {
            $columnas_seleccionadas = [
                $codigo,
                $nombre,
                $inicio,
                $jornada,
                $modalidad,
                $sede,
                $grado
            ];
            $array_datos[] = $columnas_seleccionadas;
        }
    }
}
fclose($archivo_datos); 

$array_datos_buenos = pk_unica($array_datos, 0);

$archivo_datos = fopen("../datos_aceptados/Planes_gud.csv", "w");

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