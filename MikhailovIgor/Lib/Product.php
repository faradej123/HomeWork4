<?php
namespace MikhailovIgor\Lib;

class Product{
    private $id;
    private $name; 
    private $cost; 
    private $count; 
    public function __construct($id, $name, $cost, $count)
    {
        $this->id = $id;
        $this->name = $name;
        $this->cost = $cost;
        $this->count = $count;
    }

    public function getId()
    {
        return $this->id;
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
