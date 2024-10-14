<?php 
$archivo_datos = fopen("datos_malos/Planes_carreras_bad.csv", "r");
$array_datos = [];
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode("|", $linea);
}
fclose($archivo_datos);
$conexiones = [];
$id = 0;
foreach ($array_datos as $fila) {
    $id = $id +1;
    $conexiones[] = [$id, $fila[0], $fila[1]]; 
}  
$archivo_datos = fopen("datos_aceptados/Planes_carreras_gud.csv", "w");
foreach ($conexiones as $dato) {
    $linea = implode(";", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($conexiones);

?>