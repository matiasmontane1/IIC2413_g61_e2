<?php
require "./funciones_filtro.php";

$archivo_datos = fopen("../datos_malos/Departamentos_facu_bad.csv", "r");
$array_datos = [];

while (!feof($archivo_datos)) {
    $linea = fgets($archivo_datos);

    if (hay_datos($linea)) {
        $columnas = explode("|", $linea);
        
        $nombre = mb_strtoupper(no_nulo($columnas[0]), "UTF-8");
        $nivel = no_nulo_int($columnas[1]);

        if ($nombre && $nivel) {
            $columnas_seleccionadas = [
                $nombre,
                $nivel
            ];
            $array_datos[] = $columnas_seleccionadas;
        }
    }
}
fclose($archivo_datos); 

$array_datos_buenos = agregar_id($array_datos);

$archivo_datos = fopen("../datos_aceptados/Departamentos_facu_gud.csv", "w");

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