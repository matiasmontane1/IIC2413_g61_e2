<?php
require "./funciones_filtro.php";

$archivo_datos = fopen("../datos_malos/Historial_academico_bad.csv", "r");
if ($archivo_datos === false) {
    die("Error: No se pudo abrir el archivo de entrada.");
}
$array_datos = [];
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode("|", $linea);
}
fclose($archivo_datos);

$archivo_estudiantes = fopen("../datos_aceptados/Estudiantes_gud.csv", "r");
if ($archivo_estudiantes === false) {
    die("Error: No se pudo abrir el archivo de entrada.");
}
$estudiantes_procesados = [];
while (($linea = fgets($archivo_estudiantes)) !== false) {
    $linea = trim($linea);
    $fila = explode(";", $linea);
    $nroEstudiante = trim($fila[0]);
    $estudiantes_procesados[] = no_nulo_int($nroEstudiante); // Guardar solo números de estudiantes
}
fclose($archivo_estudiantes);

$id_nota = 1;

$historiales_validos = [];

foreach ($array_datos as $fila) {
    $numeroEstudiante = trim($fila[0]);
    $sigla = trim($fila[1]);
    $periodoNota = trim($fila[2]);
    $convocatoria = trim($fila[3]);
    $calificacion = trim($fila[4]);
    $notaFinal = trim($fila[5]);

    if (in_array($numeroEstudiante, $estudiantes_procesados) && !empty($numeroEstudiante) && in_array($calificacion, ['SO', 'MB','B','SU','I','M','MM','P','NP','EX','A','R','nulo'])) {
        $notaFinal = (float)$notaFinal;

        if ($notaFinal >= 6.6 && $notaFinal <= 7.0) {
            $calificacion = 'SO';
        } elseif ($notaFinal >= 6.0 && $notaFinal <= 6.5) {
            $calificacion = 'MB';
        } elseif ($notaFinal >= 5.0 && $notaFinal <= 5.9) {
            $calificacion = 'B';
        } elseif ($notaFinal >= 4.0 && $notaFinal <= 4.9) {
            $calificacion = 'SU';
        } elseif ($notaFinal >= 3.0 && $notaFinal <= 3.9) {
            $calificacion = 'I';
        } elseif ($notaFinal >= 2.0 && $notaFinal <= 2.9) {
            $calificacion = 'M';
        } elseif ($notaFinal >= 1.0 && $notaFinal <= 1.9) {
            $calificacion = 'MM';
        } else {
            $calificacion = 'nulo';
        }


        $historiales_validos[] = [
            'id_nota' => (int)$id_nota++,
            'NumeroEstudiante' => (int)$numeroEstudiante,
            'Sigla' => strtoupper($sigla),
            'Periodo_nota' => strtoupper($periodoNota),
            'NotaFinal' => (float)$notaFinal,
            'Calificacion' => strtoupper($calificacion),
            'Convocatoria' => strtoupper($convocatoria)
        ];
    }
}

$archivo_salida = fopen("../datos_aceptados/Historial_academico_gud.csv", "w");
if ($archivo_salida === false) {
    die("Error: No se pudo abrir el archivo de salida.");
}
foreach ($historiales_validos as $dato) {
    $linea = implode(";", $dato) . "\n";
    fwrite($archivo_salida, $linea);
}
fclose($archivo_salida);
