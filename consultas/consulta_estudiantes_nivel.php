<?php include('../templates/header.html');   ?>

<body>
    <?php
        require("../config/conexion.php");

        $query = "
            SELECT 
                COUNT(CASE WHEN (EXTRACT(YEAR FROM TO_DATE(estudiantes.cohorte, 'YYYY-MM')) + 3 = EXTRACT(YEAR FROM CURRENT_DATE)) 
                        AND (estudiantes.ultimo_logro = '9') THEN 1 END) AS dentro_nivel,
                COUNT(CASE WHEN (EXTRACT(YEAR FROM TO_DATE(estudiantes.cohorte, 'YYYY-MM')) + 3 = EXTRACT(YEAR FROM CURRENT_DATE)) 
                        AND (estudiantes.ultimo_logro != '9') THEN 1 END) AS fuera_nivel
            FROM estudiantes
            JOIN estudiantes_carrera_plan ON estudiantes.NumeroEstudiante = estudiantes_carrera_plan.NumeroEstudiante
            JOIN historial_academico ON estudiantes.NumeroEstudiante = historial_academico.NumeroEstudiante
            WHERE historial_academico.Periodo_nota = '2024-2';
        ";

        $result = $db -> prepare($query);
        $result -> execute();
        $reporte = $result -> fetchAll();
    ?>

    <table class="styled-table">
        <tr>
            <th>Dentro de Nivel</th>
            <th>Fuera de Nivel</th>
        </tr>
        <?php
        foreach ($reporte as $r) {
            echo "<tr><td>$r[0]</td><td>$r[1]</td></tr>";
        }
        ?>
    </table>
<body>

<?php include('../templates/footer.html');   ?>