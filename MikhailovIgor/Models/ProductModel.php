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

    public function createNewProduct($name, $cost, $count) {
        $stmt = $this->pdo->prepare("INSERT INTO product (`name`, `cost`, `count`) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $cost);
        $stmt->bindParam(3, $count);
        $result = $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function updateProduct($productId, $name = NULL, $cost = NULL, $count = NULL) {
        return false;//TO DO
    }

    public function getProductById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `product` WHERE `id` = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $productCollection = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $productCollection;
    }
}