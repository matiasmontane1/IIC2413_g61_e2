<?php
require_once "../funciones_montane_e0.php";

$archivo_datos = fopen("../datos_malos/Personas_bad.csv", "r");
if ($archivo_datos === false) {
    die("Error: No se pudo abrir el archivo de entrada.");
}
$array_datos = [];
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode("|", $linea);
}
fclose($archivo_datos);

$personas_validas = [];

foreach ($array_datos as $fila) {
    $run = $fila[0];
    $dv = $fila[1];
    $telefono = $fila[7];
    $mailInstitucional = $fila[6];
    $mailPersonal = $fila[5];
    $Nombres = $fila[2];
    $ApellidoPaterno = $fila[3];
    $ApellidoMaterno = $fila[4];
    
    if (preg_match('/^\d{1,9}$/', $run) && strlen($run)>=6) {

        if (is_string($dv) && strlen($dv) === 1 && preg_match('/^[0-9K]$/i', $dv)) {
            $dv = strtoupper($dv);
        } else {
            $dv = 0;
        }
        

        // Verificar si el teléfono tiene 8 dígitos, si es así, agregar un '9' al inicio
        if (preg_match('/^\d{8}$/', $telefono)) {
            $telefono = '9' . $telefono;
        }

        if (!preg_match('/^\d{9}$/', $telefono)) {
            $telefono = "-";
        }

        if (!validarEmailRFC3696($mailInstitucional)) {
            $mailInstitucional = "-";
        }

        if (!validarEmailRFC3696($mailPersonal)) {
            $mailPersonal = "-";
        }


        $personas_validas[$run] = [
            'RUN' => (int)$fila[0],
            'DV' => $dv,
            'Nombres' => strtoupper($Nombres),
            'ApellidoPaterno' => strtoupper($ApellidoPaterno),
            'ApellidoMaterno' => strtoupper($ApellidoMaterno),
            'MailInstitucional' => $mailInstitucional,
            'MailPersonal' => $mailPersonal,
            'Telefono' => (int)$telefono
        ];
    }
}

$archivo_datos = fopen("../datos_aceptados/Personas_gud.csv", "w");
if ($archivo_datos === false) {
    die("Error: No se pudo abrir el archivo de salida.");
}

foreach ($personas_validas as $dato) {
    $linea = implode(";", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);