<?php

use wfm\App;

if (PHP_MAJOR_VERSION < 8) {
    die('Необходима версия PHP >= 8');
}

require_once dirname(__DIR__) . '/config/init.php';

new App();
// var_dump(App::$app->getProperties());
throw new Exception('Ошибочкаааа', 404);
echo $tes;
//5