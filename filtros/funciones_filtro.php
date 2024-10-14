<?php

function no_nulo($dato) {
    if (isset($dato) && $dato !== '') {
        return trim($dato);
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
    $linea_limpia = trim($linea);
    if (!empty($linea_limpia)) {
        return true;
    }
    return false;
}

function fecha($dato) {
    $fecha = DateTime::createFromFormat('d/m/y', $dato);
    if ($fecha && $fecha->format('d/m/y') === $dato) {
            return $dato;
    }
    return null;
}

function jornada($dato) {
    $dato_limpio = strtoupper(trim($dato));
    if ($dato_limpio === "DIURNO" || $dato_limpio === "VESPERTINO") {
            return $dato_limpio;
    }
    return null;
}

function modalidad($dato) {
    $dato_limpio = strtoupper(trim($dato));
    if ($dato_limpio === "PRESENCIAL" || $dato_limpio === "ONLINE" || $dato_limpio === "HÍBRIDA") {
            return $dato_limpio;
    }
    return null;
}

function sede($dato) {
    $dato_limpio = strtoupper(trim($dato));
    if ($dato_limpio === "HOGWARTS" || $dato_limpio === "BEAUXBATON" || $dato_limpio === "UAGADOU") {
        return $dato_limpio;
    }
    return null;
}

function grado($dato) {
    $dato_limpio = strtoupper(trim($dato));
    if ($dato_limpio === "PROGRAMA ESPECIAL" || $dato_limpio === "PREGRADO" || $dato_limpio === "POSTGRADO") {
        return $dato_limpio;
    }
    return null;
}