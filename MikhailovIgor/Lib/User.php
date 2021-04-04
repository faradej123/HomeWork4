<?php
namespace MikhailovIgor\Lib;

use Exception;

class User extends \Core\Entity {
    private $email = "";
    private $password = "";
    private $name = "";
    private $role = "";
    private $dateCreated = "";
    private $id;

    public function __construct(String $email = "", String $password = "", String $name = ""){
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setName($name);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setEmail(String $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return FALSE;
        } else {
            $this->email = $email;
            return true;
        }
    }

    public function setPassword($password)
    {

        $isValidPassword = preg_match("/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/", $password);
        if ($isValidPassword) {
            $isValidPassword = strlen($password) <= 128 ? TRUE : FALSE;
        }

        if (!$isValidPassword) {
            return FALSE;
        } else {
            $this->password = $password;
            return true;
        }
    }

    public function setName($name)
    {
        $userName = trim($name);
        $isLatinName = preg_match("/^([A-Za-z]+\s?([A-Za-z]+\s?)*)$/", $userName);
        $isRussianName = preg_match("/^([А-Яа-яЁё]+\s?([А-Яа-яЁё]+\s?)*)$/u", $userName);
        $isValidUserName = FALSE;
        $a = strlen($userName);
        if($isLatinName && strlen($userName) > 0 && strlen($userName) <= 128) {
            $isValidUserName = TRUE;
        } else if ($isRussianName && mb_strlen($userName) > 0 && mb_strlen($userName) <= 128) {
            $isValidUserName = TRUE;
        }
        if (!$isValidUserName) {
            return FALSE;
        } else {
            $this->name = $name;
            return true;
        }
    }

    public function signIn()
    {
        $this->loadModel("userModel", "UserModel");
        $userList = $this->userModel->getUsersByEmailAndPassword($this->email, $this->password);
        if (count($userList) > 0) {
            $this->setName($userList[0]["firstname"]);
            $this->setEmail($userList[0]["email"]);
            $this->dateCreated = $userList[0]["date_created"];
            $this->role = $userList[0]["role"];
            $this->id = $userList[0]["id"];
            session_start();
            $_SESSION['name'] = $this->getName();
            $_SESSION['email'] = $this->getEmail();
            $_SESSION['role'] = $this->getRole();
            $_SESSION['user_id'] = $this->getId();
            return true;
        } else {
            return false;
        }
    }

    public function checkForExistInDB()
    {
        $this->loadModel("userModel", "UserModel");
        $userList = $this->userModel->getUsersByEmail($this->email);
        if (count($userList) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function signUp()
    {
        $this->loadModel("userModel", "UserModel");
        $result = $this->userModel->insertNewUser($this->name, $this->email, $this->password);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function initUserFromSession()
    {
        session_start();
        if ($_SESSION["name"]) {
            $this->name = $_SESSION["name"];
        }
        if ($_SESSION["email"]) {
            $this->email = $_SESSION["email"];
        }
        if ($_SESSION["role"]) {
            $this->role = $_SESSION["role"];
        }
        if ($_SESSION["user_id"]) {
            $this->id = $_SESSION["user_id"];
        }
    }

    public function isAdmin()
    {
        if ($this->getRole() == "Admin") {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
