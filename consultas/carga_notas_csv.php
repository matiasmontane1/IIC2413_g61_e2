<?php
include('../config/conexion.php');

$csv_file = '../datos_aceptados/Historial_academico_gud.csv';

if (($handle = fopen($csv_file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $numeroEstudiante = $data[1];
        $sigla = $data[2];
        $notaFinal = $data[4];
        $calificacion = $data[5];

        $sql = "
        INSERT INTO Historial_academico (NumeroEstudiante, Sigla, NotaFinal, Calificacion)
        VALUES ('$numeroEstudiante', '$sigla', '$notaFinal', '$calificacion')
        ON CONFLICT (NumeroEstudiante, Sigla) DO NOTHING";
        $result = pg_query($conn, $sql);

        if (!$result) {
            echo "Error al insertar la nota del estudiante $numeroEstudiante para el curso $sigla.<br>";
        }
    }
    fclose($handle);
}

$sql_acta = "
    SELECT ha.NumeroEstudiante, p.Nombres, p.ApellidoPaterno, p.ApellidoMaterno, ha.Sigla, ha.NotaFinal, ha.Calificacion
    FROM Historial_academico ha
    JOIN Estudiantes e ON ha.NumeroEstudiante = e.NumeroEstudiante
    JOIN Personas p ON e.RUN = p.RUN";

$result_acta = pg_query($conn, $sql_acta);

echo "<h1>Acta de Notas</h1>";
while ($row = pg_fetch_assoc($result_acta)) {
    echo "Estudiante: " . $row['Nombres'] . " " . $row['ApellidoPaterno'] . " " . $row['ApellidoMaterno'] . "<br>";
    echo "Curso: " . $row['Sigla'] . "<br>";
    echo "Nota Final: " . $row['NotaFinal'] . " (" . $row['Calificacion'] . ")<br><br>";
}
?>
