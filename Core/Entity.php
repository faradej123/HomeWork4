<?php
namespace Core;

class Entity{

    public function __construct()
    {
    }

    public function loadModel($alias, $title)
    {
        $parentFolder = stristr(get_class($this), "\\Lib\\" , true);
        if ($parentFolder) {
            $model = "\\" . $parentFolder . "\\Models\\" . $title;
        } else {
            $model = "\\Models\\" . $title;
        }
        $this->$alias = new $model();
    }
}