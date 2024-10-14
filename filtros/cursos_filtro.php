<?php
require "./funciones_filtro.php";

$archivo_datos = fopen("../datos_malos/Cursos_bad.csv", "r");
$array_datos = [];

$columnas_encabezado_modificado = [
    "Sigla",
    "NombreCurso",
    "Nivel"
];

$array_datos[] = $columnas_encabezado_modificado;

while (!feof($archivo_datos)) {
    $linea = fgets($archivo_datos);

    if (hay_datos($linea)) {
        $columnas = explode("|", $linea);
        
        $sigla = no_nulo($columnas[0]);
        $nombre = def_a($columnas[1]);
        $nivel = default_int($columnas[2]);

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

$array_datos_buenos = pk_unica($array_datos, 0);

$archivo_datos = fopen("../datos_aceptados/Cursos_gud.csv", "w");

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