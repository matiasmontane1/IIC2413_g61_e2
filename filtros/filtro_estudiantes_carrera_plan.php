<?php 
$archivo_datos = fopen("datos_malos/Estudiantes_carrera_plan_bad.csv", "r");
$array_datos = [];
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode("|", $linea);
}
fclose($archivo_datos);
$conexiones = [];
$id = 0;
foreach ($array_datos as $fila) {
    $id = $id + 1;
    $carrera = str_replace("í", "Í", $fila[2]);
    $conexiones[] = [$id, (int)$fila[0], strtoupper($carrera), $fila[1]]; 

}  
$archivo_datos = fopen("datos_aceptados/Estudiantes_carrera_plan_gud.csv", "w");
foreach ($conexiones as $dato) {
    $linea = implode(";", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($conexiones);
unset($siglas)
?>