<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;
//use MikhailovIgor\Lib\ResponseToFrontEnd;
use MikhailovIgor\Lib\User;
use MikhailovIgor\Lib\OrderCollection;

class AdminController extends \Core\Controller{

    public function __construct()
    {
    }

    public function showAdminPanel()
    {
        $user = new User();
        $user->initUserFromSession();
        if($user->isAdmin()) {
            $this->data("urlToOrderList", "https://". $_SERVER['SERVER_NAME'] ."/admin/order-list");
            $this->data("urlToProductEdit", "https://". $_SERVER['SERVER_NAME'] ."/cart/product-edit");
            $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\AdminMain.php");
            $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
        } else {
            header('Location: https://' . $_SERVER['SERVER_NAME']);
        }
    }

    public function showOrders()
    {
        $user = new User();
        $user->initUserFromSession();
        if($user->isAdmin()) {
            $orders = new OrderCollection();
            $orderCollection = $orders->getAll();
            $this->data("orderCollection", $orderCollection);
            $this->data("urlToOrderList", "https://". $_SERVER['SERVER_NAME'] ."/admin/order-list");
            $this->data("urlToProductEdit", "https://". $_SERVER['SERVER_NAME'] ."/cart/product-edit");
            $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\AdminOrders.php");
            $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
        } else {
            header('Location: https://' . $_SERVER['SERVER_NAME']);
        }
    }
}