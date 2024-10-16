<?php

$archivo_datos = fopen("../datos_aceptados/Personas_gud.csv", "r");
if ($archivo_datos === false) {
    die("Error: No se pudo abrir el archivo de entrada.");
}
$jefes = [];
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $jefes[] = explode(";", $linea);
}
fclose($archivo_datos);
$jefes_pro = [];

foreach ($jefes as $j) {
    if ($j[5] != "-"){
        $jefes_pro[] = [$j[5], "00000000", "user"];
    }
}

$archivo_salida = fopen("../datos_aceptados/usuarios.csv", "w");
if ($archivo_salida === false) {
    die("Error: No se pudo abrir el archivo de salida.");
}

foreach ($jefes_pro as $dato) {
    $linea = implode(";", $dato) . "\n";
    fwrite($archivo_salida, $linea);
}
fwrite($archivo_salida, "bananer@lamejor.com;bananer0;admin");
fclose($archivo_salida);
?>