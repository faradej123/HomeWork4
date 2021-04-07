<?php
namespace MikhailovIgor\Models;
use MikhailovIgor\Lib\Product;

class CartModel extends \Core\Model{//TO DO
    public function addProductToUserCart($productId, $userId)
    {
        $this->pdo->beginTransaction();

        $productInCart = $this->selectProductFromCartByProductAndUser($productId, $userId);

        if (empty($productInCart)) {
            $productIsAded = $this->insertNewProductInCart($productId, $userId);
        } else {
            $productIsAded = $this->updateProductCountInCart($productInCart[0]["id"], ++$productInCart[0]["count"]);
        }
        if ($productIsAded) {
            $productCount = $this->getProductCountFromProduct($productId);
            if ($productCount > 0) {
                $updateResult = $this->updateProductCountInProduct($productId, --$productCount);
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
        $this->pdo->commit();
        return TRUE;
    }

    public function updateProductCountInCart($cartId, $productCount)
    {
        $stmt = $this->pdo->prepare("UPDATE `cart` SET `count` = ? WHERE `id` = ?");
        $stmt->bindParam(1, $productCount);
        $stmt->bindParam(2, $cartId);
        $result = $stmt->execute();
        return $result;
    }

    public function insertNewProductInCart($productId, $userId)
    {
        $count = 1;
        $stmt = $this->pdo->prepare("INSERT INTO `cart` (`user_id`, `product_id`, `count`) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $userId);
        $stmt->bindParam(2, $productId);
        $stmt->bindParam(3, $count);
        $result = $stmt->execute();
        return $result;
    }

    public function selectProductFromCartByProductAndUser($productId, $userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `cart` WHERE `user_id` = ? AND `product_id` = ? LIMIT 1");
        $stmt->bindParam(1, $userId);
        $stmt->bindParam(2, $productId);
        $stmt->execute();
        $productInCart = $stmt->fetchAll();
        return $productInCart;
    }

    public function getProductCountFromProduct($productId)
    {
        $stmt = $this->pdo->prepare("SELECT `count` FROM `product` WHERE `id` = ? LIMIT 1");
        $stmt->bindParam(1, $productId);
        $stmt->execute();
        $productCount = $stmt->fetchAll();
        if (count($productCount)) {
            return $productCount[0]["count"];
        } else {
            return false;
        }
    }

    public function updateProductCountInProduct($productId, $productCount)
    {
        $stmt = $this->pdo->prepare("UPDATE `product` SET `count` = ? WHERE `id` = ?");
        $stmt->bindParam(1, $productCount);
        $stmt->bindParam(2, $productId);
        $result = $stmt->execute();
        return $result;
    }

    public function selectAllProductByUserId($userId)
    {
        $stmt = $this->pdo->prepare("SELECT `cart`.`id`, `product`.`name`, `cart`.`count`, `product`.`cost` FROM `cart` LEFT JOIN `product` ON `cart`.`product_id` = `product`.`id` WHERE `user_id` = ?");
        $stmt->bindParam(1, $userId);
        $stmt->execute();
        while($productRow = $stmt->fetch()) {
            $productCollection[] = new Product($productRow["id"], $productRow["name"], $productRow["cost"], $productRow["count"]);
        }
        if (count($productCollection)) {
            return $productCollection;
        } else {
            return false;
        }
    }

    public function getCartsByProductId($productId)
    {
        $stmt = $this->pdo->prepare("SELECT `cart`.`id` as `cart_id`, `user`.`firstname` as `user_name`, `product`.`name` as `product_name`, `cart`.`count` as `count` FROM `cart` LEFT JOIN `user` ON `cart`.`user_id`=`user`.`id` LEFT JOIN `product` ON `product`.`id`=`cart`.`product_id` WHERE `cart`.`product_id` = ?;");
        $stmt->bindParam(1, $productId);
        if ($stmt->execute()) {
            $productRow = $stmt->fetchall(\PDO::FETCH_ASSOC);
            return $productRow;
        } else {
            return false;
        }
    }
    
}