<?php
require "./funciones_filtro.php";
$archivo_oferta_con = fopen("../datos_aceptados/Oferta_academica_gud.csv", "r");
$archivo_oferta_sin = fopen("../datos_aceptados/Oferta_academica_SINA_gud.csv", "r");
$archivo_prerequisitos = fopen("../datos_aceptados/Prerequisitos_gud.csv", "r");
$archivo_depa_facu = fopen("../datos_aceptados/Cursos_depa_facu_gud.csv", "r");
$array_oferta_con = [];
while (($linea = fgets($archivo_oferta_con)) !== false) {
    $linea = trim($linea);
    $array_oferta_con[] = explode(";", $linea);
}
fclose($archivo_oferta_con);
$cursos_faltante= [];
foreach($array_oferta_con as $curso){
    if (!in_array($curso[3], $cursos_faltante)){
        $cursos_faltante[] = $curso[3];
    }
}


$array_oferta_sin = [];
while (($linea = fgets($archivo_oferta_sin)) !== false) {
    $linea = trim($linea);
    $array_oferta_sin[] = explode(";", $linea);
}
fclose($archivo_oferta_sin);
foreach($array_oferta_sin as $curso){
    if (!in_array($curso[3], $cursos_faltante)){
        $cursos_faltante[] = $curso[3];
    }
}

$array_prerequisitos = [];
while (($linea = fgets($archivo_prerequisitos)) !== false) {
    $linea = trim($linea);
    $array_prerequisitos[] = explode(";", $linea);
}
fclose($archivo_prerequisitos);
foreach($array_prerequisitos as $curso){
    if (!in_array($curso[1], $cursos_faltante)){
        $cursos_faltante[] = $curso[1];
    }
}
$array_depa_facu = [];
while (($linea = fgets($archivo_depa_facu)) !== false) {
    $linea = trim($linea);
    $array_depa_facu[] = explode(";", $linea);
}
fclose($archivo_depa_facu);
foreach($array_depa_facu as $curso){
    if (!in_array($curso[1], $cursos_faltante)){
        $cursos_faltante[] = $curso[1];
    }
}
$archivo_datos = fopen("../datos_malos/Cursos_bad.csv", "r");
$array_datos = [];
$array_siglas = [];
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode("|", $linea);
}
fclose($archivo_datos);
foreach($array_datos as $dato){
    $sigla = no_nulo($dato[0]);
    $nombre = strval(def_a($dato[1]));
    $nivel = $dato[2];
    if ($sigla && $nombre) {
        $columnas_seleccionadas = [
            $sigla,
            $nombre,
            $nivel
        ];
        $array_datos[] = $columnas_seleccionadas;
        $array_siglas[] = $sigla;
    }
}  

foreach($cursos_faltante as $curso){
    if (!in_array($curso, $array_siglas)){
        $array_datos[] = [$curso, "", ""];
    }
}
$cursos_pro = [];

foreach ($array_datos as $curso) {
    $sigla = $curso[0];
    if (!isset($cursos_pro[$sigla])) {
        $cursos_pro[$sigla] = $curso;
    }
}
$array_final = array_values($cursos_pro);
$archivo_datos = fopen("../datos_aceptados/Cursos_gud.csv", "w");


foreach ($array_final as $dato) {
    $linea = implode(";", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
?>