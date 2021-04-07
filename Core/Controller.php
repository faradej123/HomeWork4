<?php
namespace Core;

class Controller{

    private $data = [];
    private $jsScripts = [];

    public function __construct()
    {
    }

    public function loadModel($alias, $title)
    {
        $parentFolder = stristr(get_class($this), "\\Controllers\\" , true);
        if ($parentFolder) {
            $model = "\\" . $parentFolder . "\\Models\\" . $title;
        } else {
            $model = "\\Models\\" . $title;
        }
        $this->$alias = new $model();
    }

    public function data($variable, $value)
    {
        $this->data[$variable] = $value;
    }

    public function addJs($fileName)
    {
        $this->jsScripts[] = "https://" . $_SERVER['SERVER_NAME'] . "/js/" . $fileName;
    }

    public function display($path)
    {
        if (file_exists($path)) {
            \extract($this->data);
            $jsScripts = $this->jsScripts;
            require_once($path);
        }
    }


}