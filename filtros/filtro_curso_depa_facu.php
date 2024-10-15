<?php 
$archivo_datos = fopen("datos_malos/Cursos_depa_facu_bad.csv", "r");
$array_datos = [];
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode("|", $linea);
}
fclose($archivo_datos);
$conexiones = [];
$id = 0;
$nuevos = [];
foreach ($array_datos as $fila) {
    $facu = str_replace("í", "Í", $fila[0]);
    if (!in_array([$fila[2], $fila[1], strtoupper($facu)], $nuevos)){
        $nuevos[] = [$fila[2], $fila[1], strtoupper($facu)];
        $id = $id + 1;
        $conexiones[] = [$id, $fila[2], (int)$fila[1], strtoupper($facu)]; 
    }
}  
$archivo_datos = fopen("datos_aceptados/Cursos_depa_facu_gud.csv", "w");
foreach ($conexiones as $dato) {
    $linea = implode(";", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($conexiones);
unset($siglas)
?>