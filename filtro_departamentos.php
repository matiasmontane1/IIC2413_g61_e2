<?php 
$archivo_datos = fopen("datos_malos/Departamentos_bad.csv", "r");
$array_datos = [];
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode("|", $linea);
}
fclose($archivo_datos);
$conexiones = [];
$siglas = [];
foreach ($array_datos as $fila) {
    if (!in_array([$fila[0]], $siglas)){
        $siglas[] = [$fila[0]];
        $conexiones[] = [$fila[0], strtoupper($fila[1])]; 
    }
}  
$archivo_datos = fopen("datos_aceptados/Departamentos_gud.csv", "w");
foreach ($conexiones as $dato) {
    $linea = implode(";", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($conexiones);
unset($siglas)
?>