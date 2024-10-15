<?php
require "./funciones_filtro.php";

$archivo_datos = fopen("../datos_malos/Estudiantes_bad.csv", "r");
$array_datos = [];

while (!feof($archivo_datos)) {
    $linea = fgets($archivo_datos);

    if (hay_datos($linea)) {
        $columnas = explode("|", $linea);
        
        $nro = no_nulo_int($columnas[0]);
        $run = no_nulo_int($columnas[1]);
        $cohorte = default_str($columnas[2]);
        $bloqueo = default_str($columnas[3]);
        $causal = default_str($columnas[4]);
        $carga = default_str($columnas[5]);
        $fecha_logro = default_str($columnas[6]);
        $logro = default_str($columnas[7]);
        $estamento = default_str($columnas[8]);


        if ($nro && $run) {
            $columnas_seleccionadas = [
                $nro,
                $run,
                $cohorte,
                $bloqueo,
                $causal,
                $carga,
                $fecha_logro,
                $logro,
                $estamento
            ];
            $array_datos[] = $columnas_seleccionadas;
        }
    }
}
fclose($archivo_datos); 

$array_datos_buenos = pk_unica($array_datos, 0);

$archivo_datos = fopen("../datos_aceptados/Estudiantes_gud.csv", "w");

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