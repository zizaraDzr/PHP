<?php

namespace app\controllers;

use app\models\Main;
use RedBeanPHP\R;

/** @property Main $model */
class MainController extends AppController
{

    public function indexAction()
    {
        $slides = R::findAll('slider');
        $products = $this->model ->get_list(1, 6);
        // debug($products, 1);
        $this->set(compact('slides', 'products'));
    }

}