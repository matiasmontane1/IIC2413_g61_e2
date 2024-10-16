<?php
    require("../config/conexion.php");



    $query = $db -> prepare("SELECT * FROM estudiantes WHERE estudiante.estamento = 'ESTUDIANTE VIGENTE';");
    $query -> execute();
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
