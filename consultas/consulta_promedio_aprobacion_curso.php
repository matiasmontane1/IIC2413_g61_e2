<?php
include('../config/conexion.php');

$codigoCurso = $_GET['codigoCurso'];

$sql = "
    SELECT p.Nombres, p.ApellidoPaterno, p.ApellidoMaterno,
           AVG(CASE WHEN ha.NotaFinal >= 4.0 THEN 1 ELSE 0 END) * 100.0 AS PromedioAprobacion
    FROM Historial_academico ha
    JOIN Cursos c ON ha.Sigla = c.Sigla
    JOIN Oferta_academica oa ON c.Sigla = oa.Sigla
    JOIN Personas p ON p.RUN = oa.RUN
    WHERE c.Sigla = '$codigoCurso'
    GROUP BY p.Nombres, p.ApellidoPaterno, p.ApellidoMaterno";

$result = pg_query($conn, $sql);

if (pg_num_rows($result) > 0) {
    echo "<h1>Promedio Histórico de Aprobación para el Curso $codigoCurso</h1>";
    while ($row = pg_fetch_assoc($result)) {
        echo "Profesor: " . $row['Nombres'] . " " . $row['ApellidoPaterno'] . " " . $row['ApellidoMaterno'] . "<br>";
        echo "Promedio de Aprobación: " . $row['PromedioAprobacion'] . "%<br><br>";
    }
} else {
    echo "No se encontraron resultados para el curso $codigoCurso.";
}
?>
