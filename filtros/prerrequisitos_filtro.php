<?php
require "./funciones_filtro.php";

$archivo_datos = fopen("../datos_malos/Prerequisitos_bad.csv", "r");
$array_datos = [];

while (!feof($archivo_datos)) {
    $linea = fgets($archivo_datos);

    if (hay_datos($linea)) {
        $columnas = explode("|", $linea);

        $sigla = no_nulo($columnas[0]);
        $req1 = default_str($columnas[1]);
        $req2 = default_str($columnas[2]);


        if ($sigla) {
            $columnas_seleccionadas = [
                $sigla,
                $req1,
                $req2
            ];
            $array_datos[] = $columnas_seleccionadas;
        }
    }
}
fclose($archivo_datos); 

$array_datos_buenos = agregar_id($array_datos);

$archivo_datos = fopen("../datos_aceptados/Prerequisitos_gud.csv", "w");

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