<?php

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