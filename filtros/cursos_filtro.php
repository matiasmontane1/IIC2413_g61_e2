<?php
require "./funciones_filtro.php";

$archivo_datos = fopen("../datos_malos/Cursos_bad.csv", "r");
$array_datos = [];

while (!feof($archivo_datos)) {
    $linea = fgets($archivo_datos);

    if (hay_datos($linea)) {
        $columnas = explode("|", $linea);
        
        $sigla = no_nulo($columnas[0]);
        $nombre = strval(def_a($columnas[1]));
        $nivel = $columnas[2];

        if ($sigla && $nombre) {
            $columnas_seleccionadas = [
                $sigla,
                $nombre,
                $nivel
            ];
            $array_datos[] = $columnas_seleccionadas;
        }
    }
}
fclose($archivo_datos); 



$archivo_datos = fopen("../datos_aceptados/Cursos_gud.csv", "w");


foreach ($array_datos as $dato) {
    $linea = implode(";", $dato);
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
?>