<?php

namespace wfm;

use Exception;

class View
{
    public string $content = '';
    public function __construct(
        public $route,
        public $layout = '',
        public $view = '', 
        public $meta = []
    )
    {
        if (false !== $this->layout) {
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    public function render($data) 
    {
        if (is_array($data)) {
            extract($data);
        }
        // admin\ => admin/
        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        //$this->route['controller'] - папка с названием контроллера
        //$this->view - папка с названием вида
        $view_file = APP . "/views/{$prefix}{$this->route['controller']}/{$this->view}.php";
        if (is_file($view_file)) {
            ob_start();
            require_once $view_file;
            // $this->content  - Доступен в шаблоне ishop.php
            $this->content = ob_get_clean();
        } else {
            throw new Exception("Не найден вид {$view_file}", 500);
        }

        if(false !== $this->layout) {
            $layout_file = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($layout_file)) {
                require_once $layout_file;
            } else {
                throw new Exception("Не найден шаблон {$layout_file}", 500);
            }
        }
    }

    public function getMeta()
    {
        $out ='<title>'. h($this->meta['title']). '</title>'. PHP_EOL;
        $out .='<meta name="description" content="'.h($this->meta['description']).'">'. PHP_EOL;
        $out .='<meta name="keywords" content="'.h($this->meta['keywords']).'">'. PHP_EOL;

        return $out;
    }
}
