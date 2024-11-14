<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'tu_base_datos';
$user = 'tu_usuario';
$password = 'tu_contraseña';

// Regla de negocio: Validar que las notas sean valores entre 1.0 y 7.0
function validarNota($nota) {
    return is_numeric($nota) && $nota >= 1.0 && $nota <= 7.0;
}

// Leer el archivo CSV
$archivoCSV = 'notas.csv'; // Reemplaza con la ruta real del archivo
$datos = [];
if (($handle = fopen($archivoCSV, 'r')) !== false) {
    while (($fila = fgetcsv($handle, 1000, ',')) !== false) {
        $datos[] = [
            'numero_alumno' => $fila[0], // Primer columna: Número de alumno
            'nota' => $fila[1]           // Segunda columna: Nota
        ];
    }
    fclose($handle);
}

try {
    // Conexión a la base de datos
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Iniciar una transacción
    $pdo->beginTransaction();

    // Crear la tabla temporal
    $pdo->exec("
        CREATE TEMP TABLE acta (
            numero_alumno INTEGER NOT NULL,
            nota NUMERIC(3, 1) NOT NULL
        );
    ");

    // Insertar datos
    foreach ($datos as $fila) {
        $numeroAlumno = $fila['numero_alumno'];
        $nota = $fila['nota'];

        // Validar la nota según las reglas de negocio
        if (!validarNota($nota)) {
            // Si hay un error, abortar la transacción
            throw new Exception("Nota de alumno $numeroAlumno contiene un valor erróneo: $nota. Corrija el archivo y vuelva a intentarlo.");
        }

        // Insertar la fila en la tabla temporal
        $stmt = $pdo->prepare("INSERT INTO acta (numero_alumno, nota) VALUES (:numero_alumno, :nota);");
        $stmt->execute([':numero_alumno' => $numeroAlumno, ':nota' => $nota]);
    }

    // Confirmar la transacción
    $pdo->commit();
    echo "Datos insertados correctamente en la tabla temporal 'acta'.\n";

} catch (Exception $e) {
    // Abortar la transacción en caso de error
    $pdo->rollBack();
    echo "Error: " . $e->getMessage() . "\n";

    // Informar los errores encontrados
    foreach ($datos as $fila) {
        $numeroAlumno = $fila['numero_alumno'];
        $nota = $fila['nota'];
        if (!validarNota($nota)) {
            echo "Error en el registro: Alumno $numeroAlumno con nota $nota (inválida).\n";
        }
    }
}
?>
