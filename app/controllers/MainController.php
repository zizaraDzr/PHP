<?php

namespace app\controllers;

use wfm\Controller;

class MainController extends Controller
{
    public function indexAction() 
    {
        var_dump($this->model);
        echo __METHOD__;
    }
}