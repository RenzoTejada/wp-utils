<?php

function limit_words($string, $word_limit) {
    $words = explode(' ', $string);
    return implode(' ', array_slice($words, 0, $word_limit));
}

// Cortar el titulo por cantidad de caracteres
function title_for_characters($length, $after = null) {
    $mytitle = get_the_title();
    $size = strlen($mytitle);
    if ($size > $length) {
        $mytitle = substr($mytitle, 0, $length);
        $mytitle = explode(' ', $mytitle);
        array_pop($mytitle);
        $mytitle = implode(" ", $mytitle) . $after;
    }
    return $mytitle;
}

function obtenerNombreDia($n) {
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

function obtenerNombreMes($n) {
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

function addHttp($url) {
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
        $url = "http://" . $url;
    }

    return $url;
}

/** Contar el Texto a una cantidad determinada   */
function cortarTexto($txt, $nr) {
    $tamano = $nr;
    $contador = 0;
    $texto = strip_tags($txt);
    if ($texto != "") { // Cortamos la cadena por los espacios 
        //$arrayTexto = split(' ',$texto);
        if ($tamano >= strlen($texto)) {
            return $texto;
        } else {
            $arrayTexto = explode(' ', $texto);
            $texto = '';

            // Reconstruimos la cadena 
            while ($tamano >= strlen($texto) + strlen(@$arrayTexto[$contador])) {
                $texto .= ' ' . @$arrayTexto[$contador];
                $contador++;
            }
            return $texto . "... ";
        }
    } else
        return "Sin descripción";
}

function bloqueo_images_pequenas($file) {
    $type = explode('/', $file['type']);
    if ($type[0] == 'image') {
        list( $width, $height, $imagetype, $hwstring, $mime, $rgb_r_cmyk, $bit ) = getimagesize($file['tmp_name']);
        if ($width < 600 && $height < 400) {
            $file['error'] = __('ERROR: La imagen no cumple con las dimensiones minimas de 600x400- ancho act:' . $width . ' alto act:' . $height, 'textdomain');
        }
    }
    return $file;
}

add_filter('wp_handle_upload_prefilter', 'bloqueo_images_pequenas', 10, 1);

// Requerir imagen destacada
add_action('save_post', 'wpds_check_thumbnail');
add_action('admin_notices', 'wpds_thumbnail_error');

function wpds_check_thumbnail($post_id) {
    // cambia esto para cualquier tipo de entrada personalizada
    if (get_post_type($post_id) != 'post')
        return;
    if (!has_post_thumbnail($post_id)) {
        // se muestra un mensaje a los usuarios
        set_transient("has_post_thumbnail", "no");
        // desengancha la funcion para evitar un look infinito
        remove_action('save_post', 'wpds_check_thumbnail');
        // actualiza la entrada y la pone como borrador
        wp_update_post(array('ID' => $post_id, 'post_status' => 'draft'));
        add_action('save_post', 'wpds_check_thumbnail');
    } else {
        delete_transient("has_post_thumbnail");
    }
}

function wpds_thumbnail_error() {
    // comprueba si falta la imagen y muestra el mensaje de error
    if (get_transient("has_post_thumbnail") == "no") {
        echo "<div id='message' class='error'><p><strong>Debes establecer una Imagen Destacada. Se ha guardado tu entrada pero no puedes publicarla aún.</strong></p></div>";
        delete_transient("has_post_thumbnail");
    }
}