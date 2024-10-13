<?php
//PLANES
$archivo_datos = fopen("../datos/Planes.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$datos_planes = [];
foreach ($array_datos as $fila) {
    $datos_planes[] = [
        'CodigoPlan' => $fila[0],
        'NombrePlan' => $fila[3],
        'InicioVigencia' => $fila[8],
        'Jornada' => $fila[4],
        'Modalidad' => $fila[7],
        'Sede' => $fila[5],
        'Grado' => $fila[6],
    ];  
}
$archivo_datos = fopen("../datos_malos/Planes_bad.csv", "w");
foreach ($datos_planes as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($datos_planes);
//Facultades
$archivo_datos = fopen("../datos/Planes.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$facus = [];
foreach ($array_datos as $fila) {
    if (!in_array($fila[1], $facus)){
         $facus[] = $fila[1];
    }   
}
$archivo_datos = fopen("../datos/Planeacion.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
foreach ($array_datos as $fila) {
    if (!in_array($fila[2], $facus)){
         $facus[] = $fila[2];
    }   
}
$real_facus = [];
foreach ($facus as $f){
    if ($f != ""){
        $real_facus[] = $f;
    }
}
$id = 0;
$datos_facu = [];
foreach ($real_facus as $fila) {
    $id = $id + 1;
    $datos_facu[] = [
        'FacultadID' => $id,
        'NombreFacultad' => $fila
    ];  
}
$archivo_datos = fopen("../datos_malos/Facultades_bad.csv", "w");
foreach ($datos_facu as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($datos_facu);

//Carreras
$archivo_datos = fopen("../datos/Planes.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$carreras = [];
foreach ($array_datos as $fila) {
   if (!in_array($fila[2], $carreras)){
        $carreras[] = $fila[2];
   }
}
$real_carreras = [];
foreach($carreras as $carrera){
    $real_carreras[] = [$carrera];
}
$archivo_datos = fopen("../datos_malos/Carreras_bad.csv", "w");
foreach ($real_carreras as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($carreras);
unset($real_carreras);
// carreras facu
$archivo_datos = fopen("../datos/Planes.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$carreras = [];
foreach ($array_datos as $fila) {
   if (!in_array([$fila[1],$fila[2]] , $carreras)){
        $carreras[] = [$fila[1],$fila[2]];
   }
}
$real_carreras = [];
foreach($carreras as $carrera){
    if ($carrera[0] != ""){
        $real_carreras[] = $carrera;
    }
}
$archivo_datos = fopen("../datos_malos/Carreras_facu_bad.csv", "w");
foreach ($real_carreras as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($carreras);
unset($real_carreras);

// planes carrera
$archivo_datos = fopen("../datos/Planes.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$carreras = [];
foreach ($array_datos as $fila) {
   if (!in_array([$fila[0],$fila[2]] , $carreras)){
        $carreras[] = [$fila[0],$fila[2]];
   }
}
$real_carreras = [];
foreach($carreras as $carrera){
    if ($carrera[0] != ""){
        $real_carreras[] = $carrera;
    }
}
$archivo_datos = fopen("../datos_malos/Planes_carreras_bad.csv", "w");
foreach ($real_carreras as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($carreras);
unset($real_carreras);
// Departamentos
$archivo_datos = fopen("../datos/Planeacion.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$departamentos = [];
foreach ($array_datos as $fila) {
   if (!in_array([$fila[3],$fila[4]] , $departamentos)){
        $departamentos[] = [$fila[3],$fila[4]];
   }
}
$real_deptos = [];
foreach($departamentos as $deptos){
    if ($deptos[0] != "" && $deptos[1] != ""){
        $real_deptos[] = $deptos;
    }
}
$archivo_datos = fopen("../datos_malos/Departamentos_bad.csv", "w");
foreach ($real_deptos as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($carreras);
unset($real_carreras);

//departamento con facultades
$archivo_datos = fopen("../datos/Planeacion.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$departamentos = [];
foreach ($array_datos as $fila) {
   if (!in_array([$fila[2],$fila[3]] , $departamentos)){
        $departamentos[] = [$fila[2],$fila[3]];
   }
}
$real_deptos = [];
foreach($departamentos as $deptos){
    if ($deptos[0] != "" && $deptos[1] != ""){
        $real_deptos[] = $deptos;
    }
}
$archivo_datos = fopen("../datos_malos/Departamentos_facu_bad.csv", "w");
foreach ($real_deptos as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($carreras);
unset($real_carreras);
?>
