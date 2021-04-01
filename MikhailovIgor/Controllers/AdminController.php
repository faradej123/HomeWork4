<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;
use MikhailovIgor\Lib\ResponseToFrontEnd;
use MikhailovIgor\Lib\User;
use MikhailovIgor\Lib\Cart;

class AdminController extends \Core\Controller{

    public function __construct()
    {
    }

    public function showAdminPanel()
    {
        $user = new User();
        $user->initUserFromSession();
        if($user->getRole() == "Admin") {
            $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\Admin.php");
            $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
        } else {
            header('Location: https://' . $_SERVER['SERVER_NAME']);
        }
    }

}