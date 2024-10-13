<?php
$archivo_datos = fopen("../datos/Estudiantes.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);

$personas = [];
foreach ($array_datos as $fila) {
    $run = $fila[6];

    if (!array_key_exists($run, $personas)) {
        $personas[$run] = [
            'RUN' => $fila[6],
            'DV' => $fila[7],
            'Nombres' => $fila[8],
            'Apellido Paterno' => $fila[9],
            'Apellido Materno' => $fila[10],
            'Telefono' => "",
            'Email Personal' => "",
            'Email Institucional' => ""
        ];
    }
}

$archivo_datos = fopen("../datos/docentes_planificados.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}

fclose($archivo_datos);

foreach ($array_datos as $fila) {
    $run = $fila[0];

    if (!array_key_exists($run, $personas)) {
        $personas[$run] = [
            'RUN' => $fila[0],
            'DV' => "",
            'Nombres' => $fila[1],
            'Apellido Paterno' => $fila[2],
            'Apelllido Materno' => "",
            'Telefono' => $fila[3],
            'Email Personal' => $fila[4],
            'Email Institucional' => $fila[5]
        ];
    }
}

$archivo_datos = fopen("../datos/Notas.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);

while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);

foreach ($array_datos as $fila) {
    $run = $fila[0];

    if (!array_key_exists($run, $personas)) {
        $personas[$run] = [
            'RUN' => $fila[4],
            'DV' => $fila[5],
            'Nombres' => $fila[6],
            'Apellido Paterno' => $fila[7],
            'Apellido Materno' => $fila[8],
            'Telefono' => "",
            'Email Personal' => "",
            'Email Institucional' => ""
        ];
    }
}


$real_personas = array_values($personas);

$archivo_datos = fopen("../datos_malos/Personas_bad.csv", "w");
foreach ($real_personas as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);

// ADMINISTRATIVOS

$archivo_datos = fopen("../datos/docentes_planificados.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);

#$ultimoRUN = '';
    #foreach ($array_datos as &$fila) {
        #if (!empty($fila[0])) {
            #$ultimoRUN = $fila[0];
        #} else {
            #$fila[0] = $ultimoRUN;
        #}
    #}

$administrativos = [];
foreach ($array_datos as $fila) {
    if ($fila[0] != "" and ($fila[15] == "Administrativo" or $fila[14] != "")) {
        $run = $fila[0];

        if (!array_key_exists($run, $administrativos)) {
            $administrativos[$run] = [
                'RUN' => $fila[0],
                'Grado Academico' => $fila[12],
                'Cargo' => $fila[14],
                'JerarquiaAcademica' => $fila[13],
                'Contrato' => $fila[7]
            ];
        }
    }
}

$archivo_datos = fopen("../datos_malos/Administrativos_bad.csv", "w");
foreach ($administrativos as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
