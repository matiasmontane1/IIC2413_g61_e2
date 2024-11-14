<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'tu_base_datos';
$user = 'tu_usuario';
$password = 'tu_contraseña';

try {
    // Conexión a la base de datos
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Definir el periodo a borrar
    $periodo = '2024-2';

    // Iniciar una transacción
    $pdo->beginTransaction();

    // Consulta para borrar las tuplas del periodo especificado
    $query = "DELETE FROM Notas WHERE periodo = :periodo;";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':periodo' => $periodo]);

    // Confirmar la transacción
    $pdo->commit();
    echo "Se han borrado todas las tuplas correspondientes al periodo $periodo.\n";

} catch (Exception $e) {
    // Abortar la transacción en caso de error
    $pdo->rollBack();
    echo "Error: " . $e->getMessage() . "\n";
}
?>
