<?php

function limit_words($string, $word_limit)
{
    $words = explode(' ', $string);
    return implode(' ', array_slice($words, 0, $word_limit));
}

function getNameDaySpanish($n)
{
    switch ($n) {
        case 1:
            $n = 'LUNES';
            break;
        case 2:
            $n = 'MARTES';
            break;
        case 3:
            $n = 'MIÉRCOLES';
            break;
        case 4:
            $n = 'JUEVES';
            break;
        case 5:
            $n = 'VIERNES';
            break;
        case 6:
            $n = 'SÁBADO';
            break;
        case 7:
            $n = 'DOMINGO';
            break;
        default:
            $n = '';
            break;
    }
    return $n;
}

function getNameMonthSpanish($n)
{
    switch ($n) {
        case 1:
            $n = 'ENERO';
            break;
        case 2:
            $n = 'FEBRERO';
            break;
        case 3:
            $n = 'MARZO';
            break;
        case 4:
            $n = 'ABRIL';
            break;
        case 5:
            $n = 'MAYO';
            break;
        case 6:
            $n = 'JUNIO';
            break;
        case 7:
            $n = 'JULIO';
            break;
        case 8:
            $n = 'AGOSTO';
            break;
        case 9:
            $n = 'SEPTIEMBRE';
            break;
        case 10:
            $n = 'OCTUBRE';
            break;
        case 11:
            $n = 'NOVIEMBRE';
            break;
        case 12:
            $n = 'DICIEMBRE';
            break;
        default:
            $n = '';
            break;
    }
    return $n;
}

function addHttp($url)
{
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
        $url = "http://" . $url;
    }
    
    return $url;
}

function cortarTexto($txt, $nr, $abrev = null)
{
    $tamano = $nr;
    $contador = 0;
    $texto = strip_tags($txt);
    if ($texto != "") {
        if ($tamano >= strlen($texto)) {
            return $texto;
        } else {
            $arrayTexto = explode(' ', $texto);
            $texto = '';
            // Reconstruimos la cadena
            while ($tamano >= strlen($texto) + strlen(@$arrayTexto[$contador])) {
                $texto .= ' ' . @$arrayTexto[$contador];
                $contador ++;
            }
            return $texto . $abrev;
        }
    } else
        return "Sin descripción";
}