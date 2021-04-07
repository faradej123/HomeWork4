<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;
use MikhailovIgor\Lib\User;
use MikhailovIgor\Lib\OrderCollection;
use MikhailovIgor\Lib\ProductCollection;
use MikhailovIgor\Lib\CartCollection;
use MikhailovIgor\Lib\Product;
use MikhailovIgor\Lib\ResponseToFrontEnd;
use Exception;

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
            $this->data("urlToProductEdit", "https://". $_SERVER['SERVER_NAME'] ."/admin/product-edit");
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
            $this->data("urlToProductEdit", "https://". $_SERVER['SERVER_NAME'] ."/admin/product-edit");
            $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\AdminOrders.php");
            $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
        } else {
            header('Location: https://' . $_SERVER['SERVER_NAME']);
        }
    }

    public function showProductEditPanel()
    {
        $user = new User();
        $user->initUserFromSession();
        if($user->isAdmin()) {
            $productCollection = new ProductCollection();
            $products = $productCollection->getAll();
            $this->addJs("AdminProductEditPanel.js");
            $this->data("products", $products);
            $this->data("urlToOrderList", "https://". $_SERVER['SERVER_NAME'] ."/admin/order-list");
            $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\AdminProducts.php");
            $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
        } else {
            header('Location: https://' . $_SERVER['SERVER_NAME']);
        }
    }

    public function deleteProduct($productId)
    {
        try {
            $responseToFrontEnd = new ResponseToFrontEnd();
            if ($productId <= 0) {
                $responseToFrontEnd->addError("product_id_is_incorrect", "Некорректный айди товара!");
                throw new Exception("product id is incorrect");
            }
            $user = new User();
            $user->initUserFromSession();
            if (!$user->isAdmin()) {
                $responseToFrontEnd->addError("not_admin", "Пользователь не админ!");
                throw new Exception("not_admin");
            }
            $orderCollection = new OrderCollection();
            $productsInOrders = $orderCollection->getProductsById($productId);
            if (count($productsInOrders)) {
                $responseToFrontEnd->addError("products_in_order_is_exist", "Невозможно удалить продукт, так как он существует в заказах!");
                throw new Exception("products_in_order_is_exist");
            }
            $cartCollection = new CartCollection();
            $carts = $cartCollection->getCartsByProductId($productId);
            if (count($carts)) {
                $responseToFrontEnd->addError("carts_is_exist", "Невозможно удалить продукт, так как он существует в корзинах!");
                throw new Exception("carts_is_exist");
            }
            $productToDelete = new Product();
            $productToDelete->setId($productId);
            $deleteResult = $productToDelete->delete();
            if (!deleteResult) {
                $responseToFrontEnd->addError("product_delete_fail", "Неизвестная шибка удаления товара с БД");
                throw new Exception("product_delete_fail");
            }
            $responseToFrontEnd->addMessage("deleted_ok", "Продукт успешно удален!");
        } catch (Exception $e) {
            
        } finally {
            $responseToFrontEnd->sendJson();
        }
    }

    public function createProduct()
    {
        //0.01 - 99999999.99
        try {
            $postBody = json_decode(file_get_contents('php://input'));
        } catch (Exception $e) {

        } finally {
            $responseToFrontEnd->sendJson();
        }
    }
}