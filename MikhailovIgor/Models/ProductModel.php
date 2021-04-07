<?php
namespace MikhailovIgor\Models;

use MikhailovIgor\Lib\Product;

class ProductModel extends \Core\Model{
    
    public function getAllProducts()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `product`");
        $stmt->execute();
        $productCollection = [];
        while($productRow = $stmt->fetch()) {
            $productCollection[] = new Product($productRow["id"], $productRow["name"], $productRow["cost"], $productRow["count"]);
        }
        return $productCollection;
    }

    public function deleteProductById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM `product` WHERE `id`=?");
        $stmt->bindParam(1, $id);
        $result = $stmt->execute();
        return $result;
    }
}