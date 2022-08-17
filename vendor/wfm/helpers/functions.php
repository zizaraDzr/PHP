<?php

use wfm\Language;

function debug($data, $die = false)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if ($die) {
        die;
    }
}

function h($str)
{
    return htmlspecialchars($str);
}

function redirect($http = false)
{
    if ($http) {
        $redirect = $http;
    } else {
        //isset($_SERVER['HTTP_REFERER'] - адрес с которого пришел пользователь
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']: PATH;
    }
    // сделать редирект
    header("Location: $redirect");
    die;
}

function base_url()
{
    return PATH .'/' . (wfm\App::$app->getProperty('lang') ? wfm\App::$app->getProperty('lang') .'/' : '');
}
// get('page')
// $_GET['page']

/**
 * @param string $key of GET array
 * @param string $type Values i, f, s
 * @return float|int|string
 */
function get($key, $type = 'i')
 {
    $param = $key;
    $$param = $_GET[$param] ?? '';
    // $page = $_GET['page'] ?? ''
    if ($type == 'i') {
        return (int)$$param;
    } elseif ($type == 'f') {
        return (float)$$param;
    } else {
        return trim($$param);
    }
 }
 /**
 * @param string $key of POST array
 * @param string $type Values i, f, s
 * @return float|int|string
 */
function post($key, $type = 'i')
{
   $param = $key;
   $$param = $_POST[$param] ?? '';
   // $page = $_GET['page'] ?? ''
   if ($type == 'i') {
       return (int)$$param;
   } elseif ($type =='f') {
       return (float)$$param;
   } else {
       return trim($$param);
   }
}

function __($key)
{
    echo Language::get($key);
}
function ___($key)
{
    return Language::get($key);
}

function get_cart_icon($id) 
{
    if (!empty($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart'])) {
        $icon = '<i class="fas fa-luggage-cart"></i>';
    } else {
        $icon = '<i class="fas fa-shopping-cart"></i>';
    }
    return $icon;
}