<?php include('../templates/header.html');   ?>

<body>
    <?php
        require("../config/conexion.php");

        $numeroEstudiante = $_POST["numeroEstudiante"];

        $query = "
            SELECT cursos.Sigla
            FROM cursos
            JOIN cursos_plan ON cursos.Sigla = cursos_plan.Sigla
            JOIN estudiantes_carrera_plan ON cursos_plan.CodigoPlan = estudiantes_carrera_plan.CodigoPlan
            WHERE estudiantes_carrera_plan.NumeroEstudiante = :numeroEstudiante AND NOT EXISTS (
                SELECT 1 FROM historial_academico
                WHERE historial_academico.NumeroEstudiante = :numeroEstudiante AND historial_academico.Sigla = cursos.Sigla
            );
        ";

        $result = $db -> prepare($query);
        $result -> bindParam(':numeroEstudiante', $numeroEstudiante, PDO::PARAM_INT);
        $result -> execute();
        $ramos = $result -> fetchAll();
    ?>

    <table class="styled-table">
        <tr>
            <th>Código Curso</th>
        </tr>
        <?php
        foreach ($ramos as $ramo) {
            echo "<tr><td>$ramo[0]</td></tr>";
        }
        ?>
    </table>
<body>

<?php include('../templates/footer.html');   ?>