<?php

use wfm\App;
use wfm\Router;

if (PHP_MAJOR_VERSION < 8) {
    die('Необходима версия PHP >= 8');
}

require_once dirname(__DIR__) . '/config/init.php';
require_once HELPERS . '/function.php';
require_once CONFIG . '/routes.php';

new App();
debug(Router::getRoutes());
// var_dump(App::$app->getProperties());
// throw new Exception('Ошибочкаааа', 404);
// echo $tes;
//5