<?php
include('../config/conexion.php');

$numeroEstudiante = $_GET['numeroEstudiante'];

$sql_verificar_vigencia = "
    SELECT * FROM Estudiantes e
    JOIN Estudiantes_carrera_plan ecp ON e.NumeroEstudiante = ecp.NumeroEstudiante
    WHERE e.NumeroEstudiante = '$numeroEstudiante'
    AND e.Ultima_carga = '2024-2'";

$result_verificar = pg_query($conn, $sql_verificar_vigencia);

if (pg_num_rows($result_verificar) > 0) {
    $sql_propuesta = "
        SELECT c.Sigla
        FROM Cursos c
        JOIN Cursos_plan cp ON c.Sigla = cp.Sigla
        JOIN Planes p ON cp.CodigoPlan = p.CodigoPlan
        WHERE p.CodigoPlan = (
            SELECT CodigoPlan FROM Estudiantes_carrera_plan WHERE NumeroEstudiante = '$numeroEstudiante'
        )";

    $result_propuesta = pg_query($conn, $sql_propuesta);

    echo "<h1>Propuesta de Ramos para el Estudiante $numeroEstudiante</h1>";
    while ($row = pg_fetch_assoc($result_propuesta)) {
        echo "Ramo: " . $row['Sigla'] . "<br>";
    }
} else {
    echo "El estudiante $numeroEstudiante no está vigente en el periodo 2024-2.";
}
?>
