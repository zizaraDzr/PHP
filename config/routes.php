<?php

use wfm\Router;


Router::add('^admin/?$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix'=> 'admin']);
Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)/?$$', ['admin_prefix'=> 'admin']);
// /? - знак '/' не обязателен
// ^$ - Пустая строка
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
// (?P<controller>) - набор символов с ключом controller
// [a-z-] - все символы и еще дефис
// + - как минимум один символ должен быть
Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');