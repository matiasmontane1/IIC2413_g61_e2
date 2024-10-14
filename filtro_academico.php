<?php 
$archivo_datos = fopen("datos_malos/Academicos_bad.csv", "r");
$array_datos = [];
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode("|", $linea);
}
fclose($archivo_datos);
$profes = [];
$jerarquias_academicas = array("ASISTENTE DOCENTE","ASISTENTE REGULAR","ASISTENTA DOCENTE","ASISTENTA REGULAR","ASOCIADO DOCENTE","ASOCIADO REGULAR","ASOCIADA DOCENTE","ASOCIADA REGULAR","INSTRUCTOR DOCENTE","INSTRUCTOR REGULAR","INSTRUCTORA DOCENTE","INSTRUCTORA REGULAR","TITULAR DOCENTE","TITULAR REGULAR","SIN JERARQUIZAR","COMISION SUPERIOR","PROFESOR ASISTENTE DOCENTE","PROFESOR ASISTENTE REGULAR","PROFESORA ASISTENTA DOCENTE","PROFESORA ASISTENTA REGULAR","PROFESOR ASOCIADO DOCENTE","PROFESOR ASOCIADO REGULAR","PROFESORA ASOCIADA DOCENTE","PROFESORA ASOCIADA REGULAR","PROFESOR INSTRUCTOR DOCENTE","PROFESOR INSTRUCTOR REGULAR","PROFESORA INSTRUCTORA DOCENTE","PROFESORA INSTRUCTORA REGULAR","PROFESOR TITULAR DOCENTE","PROFESOR TITULAR REGULAR");
$grado_academico = array("LICENCIATURA", "MAGISTER", "DOCTOR");
$contrato = array("FULL TIME", "PART TIME", "HONORARIO");
foreach ($array_datos as $fila) {
    if (strlen($fila[2]) > 0 && strlen($fila[3]) > 0){
        $jornada = strtoupper($fila[2]) . " Y " . strtoupper($fila[3]);
    }
    else {
        $jornada = strtoupper($fila[2]) . strtoupper($fila[3]);
    }
    if (in_array(trim($fila[1]), $grado_academico) && strlen($jornada) > 0 && in_array(trim($fila[4]), $jerarquias_academicas) && in_array(trim($fila[5]), $contrato)){
        $profes[] = [$fila[0],trim($fila[1]), $jornada, $fila[4], $fila[5], 0]; 
    }
}  
$archivo_datos = fopen("datos_aceptados/Academicos_gud.csv", "w");
foreach ($profes as $dato) {
    $linea = implode(";", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($profes);

?>