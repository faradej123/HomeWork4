<?php
namespace MikhailovIgor\Lib;

class Product{
    private $name; 
    private $cost; 
    private $count; 
    public function __construct($name, $cost, $count)
    {
        $this->name = $name;
        $this->cost = $cost;
        $this->count = $count;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function getCount()
    {
        return $this->count;
    }
}
