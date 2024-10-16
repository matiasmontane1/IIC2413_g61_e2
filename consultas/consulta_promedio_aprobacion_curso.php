<?php
    require("../config/conexion.php");

    $codigoCurso = $_POST["codigoCurso"];

    $query = "
        SELECT personas.Nombres, personas.ApellidoPaterno, 
            AVG((COUNT(CASE WHEN historial_academico.Calificacion IN ('SO', 'MB', 'B', 'SU') THEN 1 END) * 100.0) / COUNT(*)) AS promedio_aprobacion
        FROM historial_academico
        JOIN cursos ON historial_academico.Sigla = cursos.Sigla
        JOIN oferta_academica ON cursos.Sigla = oferta_academica.Sigla
        JOIN academicos ON oferta_academica.RUN = academicos.RUN
        JOIN personas ON academicos.RUN = personas.RUN
        WHERE cursos.Sigla = :codigoCurso
        GROUP BY personas.Nombres, personas.ApellidoPaterno;
    ";

    $result = $db -> prepare($query);
    $result -> bindParam(':codigoCurso', $codigoCurso, PDO::PARAM_STR);
    $result -> execute();
    $profesores = $result -> fetchAll();
?>

<table class="styled-table">
    <tr>
        <th>Profesor</th>
        <th>Promedio de Aprobación</th>
    </tr>
    <?php
    foreach ($profesores as $profesor) {
        echo "<tr><td>$profesor[0] $profesor[1]</td><td>$profesor[2]%</td></tr>";
    }
    ?>
</table>
