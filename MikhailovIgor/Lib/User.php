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
            $sessionId = md5($userList[0]["email"] . $_SERVER["HTTP_USER_AGENT"] . "ololo" . time());
            $result = $this->userModel->insertSession($sessionId, $userList[0]["id"], time()+60*60);
            if ($result) {
                session_start();
                $_SESSION['id'] = $sessionId;
                $_SESSION['name'] = $userList[0]["firstname"];
                $_SESSION['email'] = $userList[0]["email"];
                return true;
            } else {
                return false;
            }
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
        $this->loadModel("userModel", "UserModel");
        session_set_cookie_params(time()+60*24, '/', $_SERVER['SERVER_NAME'], TRUE, TRUE);
        session_start();
        $result = $this->userModel->getUserBySessionId($_SESSION["id"]);

        if ($result) {
            $this->id = $result[0]["id"];
            $this->name = $result[0]["firstname"];
            $this->email = $result[0]["email"];
            $this->role = $result[0]["role"];
            $this->dateCreated = $result[0]["date_created"];
        } else {
            return false;
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
