<?php
include('../config/conexion.php');

$sql_dentro_nivel = "
SELECT e.NumeroEstudiante, p.Nombres, p.ApellidoPaterno, p.ApellidoMaterno, e.Cohorte, e.Fecha_logro 
FROM Estudiantes e 
JOIN Personas p ON e.RUN = p.RUN
WHERE e.Cohorte = e.Fecha_logro";

$sql_fuera_nivel = "
SELECT e.NumeroEstudiante, p.Nombres, p.ApellidoPaterno, p.ApellidoMaterno, e.Cohorte, e.Fecha_logro 
FROM Estudiantes e 
JOIN Personas p ON e.RUN = p.RUN
WHERE e.Cohorte != e.Fecha_logro";

$result_dentro_nivel = pg_query($conn, $sql_dentro_nivel);
$result_fuera_nivel = pg_query($conn, $sql_fuera_nivel);

echo "<h1>Estudiantes Dentro de Nivel</h1>";
while ($row = pg_fetch_assoc($result_dentro_nivel)) {
    echo "Estudiante: " . $row['Nombres'] . " " . $row['ApellidoPaterno'] . " " . $row['ApellidoMaterno'] . " | Cohorte: " . $row['Cohorte'] . "<br>";
}

echo "<h1>Estudiantes Fuera de Nivel</h1>";
while ($row = pg_fetch_assoc($result_fuera_nivel)) {
    echo "Estudiante: " . $row['Nombres'] . " " . $row['ApellidoPaterno'] . " " . $row['ApellidoMaterno'] . " | Cohorte: " . $row['Cohorte'] . "<br>";
}
?>
