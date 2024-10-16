<?php
require('../config/conexion.php');

// Validar que se recibió el parámetro periodo
if (!isset($_GET['periodo'])) {
    echo json_encode(['error' => 'Periodo no especificado']);
    exit();
}

$periodo = $_GET['periodo'];

// Consulta SQL
$sql = "
    SELECT c.Sigla, c.NombreCurso, p.Nombres, p.ApellidoPaterno, p.ApellidoMaterno,
           (SUM(CASE WHEN ha.NotaFinal >= 4.0 THEN 1 ELSE 0 END) * 100.0 / COUNT(*)) AS PorcentajeAprobacion
    FROM Cursos c
    JOIN Historial_academico ha ON c.Sigla = ha.Sigla
    JOIN Oferta_academica oa ON c.Sigla = oa.Sigla
    JOIN Personas p ON p.RUN = oa.RUN
    WHERE ha.Periodo_nota = ?
    GROUP BY c.Sigla, c.NombreCurso, p.Nombres, p.ApellidoPaterno, p.ApellidoMaterno";

// Ejecutar consulta usando la función específica
$result = db_exec($sql, [$periodo]);

// Mostrar resultados en formato JSON
if (!$result) {
    echo json_encode(['error' => 'Error en la consulta']);
    exit();
}

$rows = [];
while ($row = db_fetch_assoc($result)) {
    $rows[] = $row;
}

echo json_encode($rows);
?>
