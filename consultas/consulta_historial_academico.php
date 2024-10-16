<?php
include('../config/conexion.php');

$numeroEstudiante = $_GET['numeroEstudiante'];

$sql_historial = "
    SELECT ha.Periodo_nota, c.Sigla, c.NombreCurso, ha.NotaFinal, ha.Calificacion
    FROM Historial_academico ha
    JOIN Cursos c ON ha.Sigla = c.Sigla
    WHERE ha.NumeroEstudiante = '$numeroEstudiante'
    ORDER BY ha.Periodo_nota ASC";

$result_historial = pg_query($conn, $sql_historial);

$periodo_actual = "";
$aprobados = 0;
$reprobados = 0;

if (pg_num_rows($result_historial) > 0) {
    echo "<h1>Historial Académico del Estudiante $numeroEstudiante</h1>";
    while ($row = pg_fetch_assoc($result_historial)) {
        if ($periodo_actual != $row['Periodo_nota']) {
            if ($periodo_actual != "") {
                echo "Aprobados: $aprobados, Reprobados: $reprobados<br><br>";
            }
            $periodo_actual = $row['Periodo_nota'];
            echo "<h2>Periodo: $periodo_actual</h2>";
            $aprobados = 0;
            $reprobados = 0;
        }
        echo "Curso: " . $row['Sigla'] . " - " . $row['NombreCurso'] . "<br>";
        echo "Nota Final: " . $row['NotaFinal'] . " (" . $row['Calificacion'] . ")<br>";
        if ($row['NotaFinal'] >= 4.0) {
            $aprobados++;
        } else {
            $reprobados++;
        }
    }
    echo "Aprobados: $aprobados, Reprobados: $reprobados<br>";
} else {
    echo "No se encontraron registros para el estudiante $numeroEstudiante.";
}
?>
