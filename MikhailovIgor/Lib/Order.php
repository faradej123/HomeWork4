<?php
namespace MikhailovIgor\Lib;
use Exception;

class Order extends \Core\Entity {

    private $userId;

    public function __construct(Int $userId)
    {
        if ($userId > 0) {
            $this->userId = $userId;
        } else {
            throw new Exception("Передан неправильный параметр в конструктор, userId должен быть числом выше 0");
        }
    }

    public function confirmOrder()
    {
        $this->loadModel("orderModel", "OrderModel");
        if ($this->userId > 0) {
            $createOrderResult = $this->orderModel->confirmOrder($this->userId);
            if (!$createOrderResult) {
                return false;
            }
        } else {
            return false;
        }
        return true;
    }

}
