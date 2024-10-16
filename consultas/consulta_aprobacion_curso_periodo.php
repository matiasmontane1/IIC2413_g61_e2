<?php
include('../config/conexion.php');

$periodo = $_GET['periodo'];

$sql = "
    SELECT c.Sigla, c.NombreCurso, p.Nombres, p.ApellidoPaterno, p.ApellidoMaterno,
           (SUM(CASE WHEN ha.NotaFinal >= 4.0 THEN 1 ELSE 0 END) * 100.0 / COUNT(*)) AS PorcentajeAprobacion
    FROM Cursos c
    JOIN Historial_academico ha ON c.Sigla = ha.Sigla
    JOIN Oferta_academica oa ON c.Sigla = oa.Sigla
    JOIN Personas p ON p.RUN = oa.RUN
    WHERE ha.Periodo_nota = '$periodo'
    GROUP BY c.Sigla, c.NombreCurso, p.Nombres, p.ApellidoPaterno, p.ApellidoMaterno";

$result = pg_query($conn, $sql);

if (pg_num_rows($result) > 0) {
    echo "<h1>Cursos y Porcentaje de Aprobación para el Periodo $periodo</h1>";
    while ($row = pg_fetch_assoc($result)) {
        echo "Curso: " . $row['Sigla'] . " - " . $row['NombreCurso'] . "<br>";
        echo "Profesor: " . $row['Nombres'] . " " . $row['ApellidoPaterno'] . " " . $row['ApellidoMaterno'] . "<br>";
        echo "Porcentaje de Aprobación: " . $row['PorcentajeAprobacion'] . "%<br><br>";
    }
} else {
    echo "No se encontraron resultados para el periodo $periodo.";
}
?>
