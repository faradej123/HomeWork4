<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;
use MikhailovIgor\Lib\User;
use MikhailovIgor\Lib\ProductsRepo;

class HomePageController extends \Core\Controller{
    public function __construct()
    {
    }

    public function showProducts(){
        $user = new User();
        $user->initUserFromSession();
        if ($user->checkForExistInDB()) {
            $productCollection = new ProductsRepo();
            $products = $productCollection->getAllProducts();
            if ($productCollection) {
                $jsScripts = ["https://" . $_SERVER['SERVER_NAME'] . "/js/HomePage.js"];
                $this->data("products", $products);
                $this->data("jsScripts", $jsScripts);
                $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\HomePage.php");
            }
        } else {
            $this->data("actionScript", "https://". $_SERVER['SERVER_NAME'] ."/signin/do");
            $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\SignIn.php");
        }
        
        $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
    }

}