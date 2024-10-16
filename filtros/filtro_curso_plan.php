<?php 
$archivo_datos = fopen("../datos_malos/Cursos_plan_bad.csv", "r");
$array_datos = [];
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode("|", $linea);
}
fclose($archivo_datos);
$archivo_datos = fopen("../datos_aceptados/Cursos_gud.csv", "r");
$array_datos_c = [];
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos_c[] = explode(";", $linea);
}
fclose($archivo_datos);
$cursos =[];
foreach($array_datos_c as $curso){
    if (!in_array($curso[0], $cursos)){
        $cursos[] = $curso[0];
    }
}
$conexiones = [];
$id = 0;
$nuevos = [];
foreach ($array_datos as $fila) {
    if (in_array($fila[1], $cursos)){
        if (!in_array([$fila[1], $fila[0]], $nuevos)){
        $nuevos[] = [$fila[1], $fila[0]];
        $id = $id + 1;
        $conexiones[] = [$id, strval(trim($fila[0])), $fila[1]]; 
        }
    }
    
}  
$archivo_datos = fopen("../datos_aceptados/Cursos_plan_gud.csv", "w");
foreach ($conexiones as $dato) {
    $linea = implode(";", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($conexiones);
unset($siglas)
?>