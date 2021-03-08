<?php
namespace Core;

class Controller{

    private $data = [];

    public function __construct()
    {
    }

    public function loadModel($alias, $title)
    {
        $model = "\\Mikhailovigor\\Models\\" . $title;
        $this->$alias = new $model();
    }

    public function data($variable, $value)
    {
        $this->data[$variable] = $value;
    }

    public function display($path)
    {
        if (file_exists($path)) {
            \extract($this->data);
            require_once($path);
        }
    }


}