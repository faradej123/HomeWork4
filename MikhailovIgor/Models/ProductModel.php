<?php
namespace MikhailovIgor\Models;

use MikhailovIgor\Lib\Product;

class ProductModel extends \Core\Model{
    
    public function getAllProducts()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `product`");
        $stmt->execute();
        //$productList = $stmt->fetchAll();
        $productCollection = [];
        while($productRow = $stmt->fetch()) {
            $productCollection[] = new Product($productRow["id"], $productRow["name"], $productRow["cost"], $productRow["count"]);
        }
        return $productCollection;
    }
}