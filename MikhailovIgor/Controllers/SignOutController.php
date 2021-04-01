<?php
namespace MikhailovIgor\Controllers;
use Core\Configs\Consts;

class SignOutController extends \Core\Controller{


    public function __construct()
    {
    }

    public function signOut()
    {
        session_start();
        session_unset();
        if ($_SERVER['HTTP_REFERER'] != null) {
            header("Location: ".$_SERVER['HTTP_REFERER']);
        } else {
            header("Location: /");
        }
    }


}