<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;
use MikhailovIgor\Lib\User;
use MikhailovIgor\Lib\ProductCollection;

class HomePageController extends \Core\Controller{
    public function __construct()
    {
    }

    public function showProducts(){
        $user = new User();
        $user->initUserFromSession();
        if ($user->checkForExistInDB()) {
            $productCollection = new ProductCollection();
            $products = $productCollection->getAll();
            if ($productCollection) {
                $this->addJs("HomePage.js");
                $this->data("products", $products);
                $this->data("jsScripts", $jsScripts);
                $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\HomePage.php");
            }
        } else {
            session_start();
            if($_SESSION["user_not_found"]) {
                echo("<p>" . $_SESSION["user_not_found"] . "</p>");
                session_unset();
            }
            $this->data("actionScript", "https://". $_SERVER['SERVER_NAME'] ."/signin/do");
            $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\SignIn.php");
        }
        
        $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
    }

}