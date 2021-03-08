<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;

class SignInController extends \Core\Controller{

    private $productList = [];

    public function __construct()
    {
    }

    public function showSignInForm()
    {
        $this->data("template", Consts::DOCUMENT_ROOT . "\\MikhailovIgor\\Views\\SignIn.php");
        $this->display(Consts::DOCUMENT_ROOT . "MikhailovIgor\\Views\\index.php");
    }
}