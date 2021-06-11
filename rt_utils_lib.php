<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

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

function addHttps($url)
{
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
        $url = "https://" . $url;
    }

    return $url;
}

function rt_utils_remove_version()
{
    return '';
}

function rt_utils_disable_rsd()
{
    if (get_option('utils_disable_rsd_checkbox') == 'on') {
        remove_action('wp_head', 'rsd_link');
    }
}

function rt_utils_remove_wp_ver()
{
    if (get_option('utils_remove_wp_ver_checkbox') == 'on') {
        add_filter('the_generator', 'rt_utils_remove_version');
    }
}

function rt_utils_remove_wlwmanifest()
{
    if (get_option('utils_remove_wlwmanifest_checkbox') == 'on') {
        remove_action('wp_head', 'wlwmanifest_link');
    }
}

function rt_utils_remove_shortlink()
{
    if (get_option('utils_remove_shortlink_checkbox') == 'on') {
        remove_action('wp_head', 'wp_shortlink_wp_head');
    }
}

function rt_utils_disable_api()
{
    if (get_option('utils_disable_api_checkbox') == 'on') {
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        remove_action('template_redirect', 'rest_output_link_header', 11, 0);
    }
}

function rt_utils_remove_discore_links()
{
    if (get_option('utils_remove_discore_links_checkbox') == 'on') {
        remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
    }
}


