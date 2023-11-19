<?php

function sinTildes($frase)
{
    $no_permitidas = array(
        "á",
        "é",
        "í",
        "ó",
        "ú",
        "Á",
        "É",
        "Í",
        "Ó",
        "Ú",
        "à",
        "è",
        "ì",
        "ò",
        "ù",
        "À",
        "È",
        "Ì",
        "Ò",
        "Ù"
    );
    $permitidas = array(
        "a",
        "e",
        "i",
        "o",
        "u",
        "A",
        "E",
        "I",
        "O",
        "U",
        "a",
        "e",
        "i",
        "o",
        "u",
        "A",
        "E",
        "I",
        "O",
        "U"
    );
    $texto = str_replace($no_permitidas, $permitidas, $frase);
    return $texto;
}

function sinEspacios(string $cadena): string
{
    $texto = trim(preg_replace('/ +/', " ", $cadena));
    return $texto;
}

function recoge(string $var): string
{
    if (isset($_REQUEST[$var]) && (!is_array($_REQUEST[$var]))) {
        $tmp = sinEspacios($_REQUEST[$var]);
        $tmp = strip_tags($tmp);
    } else
        $tmp = "";

    return $tmp;
}

function cTexto(string $text, string $campo, array &$errores, int $max = 30, int $min = 1, bool $espacios = TRUE, bool $case = TRUE)
{
    $case = ($case === TRUE) ? "i" : "";
    $espacios = ($espacios === TRUE) ? " " : "";
    if ((preg_match("/^[a-zñ0-9$espacios]{" . $min . "," . $max . "}$/u$case", sinTildes($text)))) {
        return true;
    }
    $errores[$campo] = "Error en el campo $campo";
    return false;
}

function cNum(string $num, string $campo, array &$errores, bool $requerido = TRUE, int $max = PHP_INT_MAX)
{
    $cuantificador = ($requerido) ? "+" : "*";
    if ((preg_match("/^[-0-9]" . $cuantificador . "\.?[0-9]+$/", $num)) && ($num <= $max)) {

        return true;
    }
    $errores[$campo] = "Error en el campo $campo";
    return false;
}

function cFecha(string $date, string $campo, array &$errores)
{   if(!$date == "") {
        if(count(explode("/", $date))==3) {
            list($m,$d,$y) = explode("/", $date);
            if(checkdate($m,$d,$y)) {
                return true;
            }
        }else {
            $errores[$campo] = "Error en el campo $campo";
            return false;
        }
        
        
    }
        
    $errores[$campo] = "Error en el campo $campo";
    return false;
}