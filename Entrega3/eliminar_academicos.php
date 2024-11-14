<?php

try {
    require("../config/conexion.php");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function getDependencies($db, $tableName) {
        $query = "
            SELECT conname, conrelid::regclass AS table_name, a.attname AS column_name
            FROM pg_constraint c
            JOIN pg_attribute a ON a.attnum = ANY(c.conkey) AND a.attrelid = c.conrelid
            WHERE confrelid = :tableName::regclass;
        ";
        $stmt = $db->prepare($query);
        $stmt->execute([':tableName' => $tableName]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $profesoresDependencies = getDependencies($db, 'academicos');

    function dropColumns($db, $dependencies) {
        foreach ($dependencies as $dependency) {
            $table = $dependency['table_name'];
            $column = $dependency['column_name'];
            $query = "ALTER TABLE $table DROP COLUMN $column CASCADE;";
            $db->exec($query);
            echo "Eliminada la columna $column de la tabla $table.\n";
        }
    }

    dropColumns($db, $profesoresDependencies);

    $tablesToDrop = ['academicos'];
    foreach ($tablesToDrop as $table) {
        $query = "DROP TABLE IF EXISTS $table CASCADE;";
        $db->exec($query);
        echo "Eliminada la tabla $table.\n";
    }

    echo "Tarea completada con éxito.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
