<?php
$archivo_datos = fopen("datos_malos/Administrativos_bad.csv", "r");
if ($archivo_datos === false) {
    die("Error: No se pudo abrir el archivo de entrada.");
}
$array_datos = [];
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode("|", $linea);
}
fclose($archivo_datos);

$administrativos_validos = [];

foreach ($array_datos as $fila) {
    $run = $fila[0];
    $contrato = $fila[4];
    $dedicacion = $fila[5];

    if ($dedicacion == "") {
        $dedicacion = 0;
    }
    

    if (preg_match('/^\d{1,8}$/', $run) && in_array($contrato, ["FULL TIME", "PART TIME", "HONORARIO"]) && (int)$dedicacion <= 40 && (int)$dedicacion >= 0) {

        $administrativos_validos[$run] = [
            'RUN' => (int)$fila[0],
            'Grado Academico' => strtoupper($fila[1]),
            'Cargo' => strtoupper($fila[2]),
            'JerarquiaAcademica' => strtoupper($fila[3]),
            'Contrato' => strtoupper($fila[4]),
            'Dedicacion' => (int)$fila[5]
        ];
    }
}

$archivo_salida = fopen("datos_aceptados/Administrativos_gud.csv", "w");
if ($archivo_salida === false) {
    die("Error: No se pudo abrir el archivo de salida.");
}
foreach ($administrativos_validos as $dato) {
    $linea = implode(";", $dato) . "\n";
    fwrite($archivo_salida, $linea);
}
fclose($archivo_salida);