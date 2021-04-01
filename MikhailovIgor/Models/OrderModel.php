<?php
namespace MikhailovIgor\Models;
use Exception;

class OrderModel extends \Core\Model {
    
    public function confirmOrder($userId)
    {
        try {
            $this->pdo->beginTransaction();
            if ($userId <= 0) {
                throw new Exception("UserId argument is incorrect");
            }
            $orderID = $this->createNewOrder($userId);
            if ($orderID <= 0) {
                throw new Exception("orderID is incorrect");
            }
            $productsInCart = $this->getProductsFromCart($userId);
            if (!$productsInCart) {
                throw new Exception("not found products in cart");
            }
            $isInserted = $this->insertProductsFromCartToOrder($productsInCart, $orderID);
            if (!$isInserted) {
                throw new Exception("insert from cart to order - fail");
            }
            $isDeleted = $this->deleteProductsFromCart($userId);
            if (!$isDeleted) {
                throw new Exception("delete products from cart - fail");
            }
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function createNewOrder($userId)
    {
        $stmt = $this->pdo->prepare("INSERT INTO `order` (`date_created`, `user_id`) VALUES (?, ?)");
        $stmt->bindParam(1, time());
        $stmt->bindParam(2, $userId);
        $result = $stmt->execute();
        if ($result) {
            return $this->pdo->lastInsertId();
        } else {
            return FALSE;
        }
    }

    public function getProductsFromCart($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `cart` WHERE `user_id` = ?");
        $stmt->bindParam(1, $userId);
        $stmt->execute();
        $product = $stmt->fetchAll();
        return $product;
    }

    public function insertProductsFromCartToOrder($productsInCart, $orderID)
    {
        $count = 0;
        foreach ($productsInCart as $product) {
            $stmt = $this->pdo->prepare("INSERT INTO `order_products` (`order_id`, `product_id`, `count`) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $orderID);
            $stmt->bindParam(2, $product["product_id"]);
            $stmt->bindParam(3, $product["count"]);
            $result = $stmt->execute();
            if ($result) {
                $count++;
            }
        }
        if (count($productsInCart) == $count) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProductsFromCart($userId)
    {
        $stmt = $this->pdo->prepare("DELETE FROM `cart` WHERE `user_id`=?");
        $stmt->bindParam(1, $userId);
        $result = $stmt->execute();
        if (!$result) {
            return false;
        } else {
            return true;
        }
    }
}