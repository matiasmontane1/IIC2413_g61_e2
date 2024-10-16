<?php include('../templates/header.html');   ?>

<body>    
    <?php
        require("../config/conexion.php");

        $periodo = $_POST["periodo"];

        $query = "
            SELECT cursos.Sigla, cursos.NombreCurso, personas.Nombres, personas.ApellidoPaterno, 
                (COUNT(CASE WHEN historial_academico.Calificacion IN ('SO', 'MB', 'B', 'SU') THEN 1 END) * 100.0) / COUNT(*) AS porcentaje_aprobacion
            FROM historial_academico
            JOIN cursos ON historial_academico.Sigla = cursos.Sigla
            JOIN oferta_academica ON cursos.Sigla = oferta_academica.Sigla
            JOIN academicos ON oferta_academica.RUN = academicos.RUN
            JOIN personas ON academicos.RUN = personas.RUN
            WHERE historial_academico.Periodo_nota = :periodo
            GROUP BY cursos.Sigla, cursos.NombreCurso, personas.Nombres, personas.ApellidoPaterno;
        ";

        $result = $db -> prepare($query);
        $result -> bindParam(':periodo', $periodo, PDO::PARAM_STR);
        $result -> execute();
        $cursos = $result -> fetchAll();
    ?>

    <table class="styled-table">
        <tr>
            <th>Código Curso</th>
            <th>Nombre Curso</th>
            <th>Profesor</th>
            <th>Porcentaje de Aprobación</th>
        </tr>
        <?php
        foreach ($cursos as $curso) {
            echo "<tr><td>$curso[0]</td><td>$curso[1]</td><td>$curso[2] $curso[3]</td><td>$curso[4]%</td></tr>";
        }
        ?>
    </table>
<body>

<?php include('../templates/footer.html');   ?>