<?php

function no_nulo($dato) {
    if (isset($dato) && $dato !== '') {
        return preg_replace('/^\s+|\s+$/u', '', $dato);
    } else {
        return null;
    }
}

function no_nulo_int($dato) {
    if (isset($dato) && filter_var($dato, FILTER_VALIDATE_INT) !== false) {
        return (int)$dato;
    }
    return null;
}

function pk_unica($array_datos, $columna_pk) {
    $valores_vistos = [];
    $resultado = [];
    foreach ($array_datos as $tupla) {
        if (!in_array($tupla[$columna_pk], $valores_vistos)) {
            $resultado[] = $tupla;
            $valores_vistos[] = $tupla[$columna_pk];
        }
    }
    return $resultado;
}

function hay_datos($linea) {
    $linea_limpia = preg_replace('/^\s+|\s+$/u', '', $linea);
    if (!empty($linea_limpia)) {
        return true;
    }
    return false;
}

function fecha($dato) {
    $datolimpio = preg_replace('/^\s+|\s+$/u', '', $dato);
    $fecha = DateTime::createFromFormat('d/m/y', $datolimpio);
    if ($fecha && $fecha->format('d/m/y') === $dato) {
            return $dato;
    }
    return null;
}

function jornada($dato) {
    $dato_limpio = strtoupper(preg_replace('/^\s+|\s+$/u', '', $dato));
    if ($dato_limpio === "DIURNO" || $dato_limpio === "VESPERTINO") {
            return $dato_limpio;
    }
    return null;
}

function modalidad($dato) {
    $dato_limpio = strtoupper(preg_replace('/^\s+|\s+$/u', '', $dato));
    if ($dato_limpio === "PRESENCIAL" || $dato_limpio === "ONLINE" || $dato_limpio === "HÍBRIDA") {
            return $dato_limpio;
    }
    return null;
}

function sede($dato) {
    $dato_limpio = strtoupper(preg_replace('/^\s+|\s+$/u', '', $dato));
    if ($dato_limpio === "HOGWARTS" || $dato_limpio === "BEAUXBATON" || $dato_limpio === "UAGADOU") {
        return $dato_limpio;
    }
    return null;
}

function grado($dato) {
    $dato_limpio = strtoupper(preg_replace('/^\s+|\s+$/u', '', $dato));
    if ($dato_limpio === "PROGRAMA ESPECIAL" || $dato_limpio === "PREGRADO" || $dato_limpio === "POSTGRADO") {
        return $dato_limpio;
    }
    return null;
}

function default_int($dato) {
    if (filter_var($dato, FILTER_VALIDATE_INT) !== false) {
        return (int)$dato;
    }
    if (is_numeric($dato)) {
        return (int)$dato;
    }
    return "-";
}

function default_str($dato) {
    if (!empty(preg_replace('/^\s+|\s+$/u', '', $dato))) {
        return preg_replace('/^\s+|\s+$/u', '', $dato);
    }
    return "-";
}

function def_a($cadena) {
    $cadena_limpia = preg_replace('/^\s+|\s+$/u', '', $cadena);
    if (!empty($cadena_limpia)) {
        return str_replace("´", "Á", $cadena_limpia);
    }
    return null;
}

function agregar_id($array_con_encabezados, $nombre_nueva_columna) {
    $encabezados = array_shift($array_con_encabezados);
    $array_datos_unicos = array_map("unserialize", array_unique(array_map("serialize", $array_con_encabezados)));
    foreach ($array_datos_unicos as $indice => &$tupla) {
        array_unshift($tupla, $indice + 1);
    }
    array_unshift($encabezados, $nombre_nueva_columna);
    array_unshift($array_datos_unicos, $encabezados);
    return $array_datos_unicos;
}
