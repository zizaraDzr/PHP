<?php

namespace app\controllers;

use wfm\Controller;

class MainController extends Controller
{
    public function indexAction() 
    {
        $name =['j', 'dsa', 'dasd'];
        $this->setMeta('titlee', 'описание', 'keywords');
        // $this->set(['test' => 'test Var']);
        $this->set(['name' => $name]);
        $this->set(compact('name'));
    }
}