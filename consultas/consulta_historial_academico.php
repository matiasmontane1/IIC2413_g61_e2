<?php
    require("../config/conexion.php");

    $numeroEstudiante = $_POST["numeroEstudiante"];

    $query = "
        SELECT historial_academico.Periodo_nota, cursos.Sigla, cursos.NombreCurso, historial_academico.NotaFinal, historial_academico.Calificacion
        FROM historial_academico
        JOIN cursos ON historial_academico.Sigla = cursos.Sigla
        WHERE historial_academico.NumeroEstudiante = :numeroEstudiante
        ORDER BY historial_academico.Periodo_nota ASC;
    ";

    $result = $db -> prepare($query);
    $result -> bindParam(':numeroEstudiante', $numeroEstudiante, PDO::PARAM_INT);
    $result -> execute();
    $historial = $result -> fetchAll();
?>

<table class="styled-table">
    <tr>
        <th>Periodo</th>
        <th>Sigla Curso</th>
        <th>Nombre Curso</th>
        <th>Nota Final</th>
        <th>Calificación</th>
    </tr>
    <?php
    foreach ($historial as $entry) {
        echo "<tr><td>$entry[0]</td><td>$entry[1]</td><td>$entry[2]</td><td>$entry[3]</td><td>$entry[4]</td></tr>";
    }
    ?>
</table>
