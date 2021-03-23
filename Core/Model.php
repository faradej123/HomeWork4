<?php
namespace Core;
use Core\DBConnector;

class Model{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = DBConnector::getPdo();
    }

}