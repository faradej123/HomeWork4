<?php
namespace MikhailovIgor\Models;

class UserModel extends \Core\Model{

    public function getUsersByEmail($userEmail)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `email` =  ?");
        $stmt->bindParam(1, $userEmail);
        $stmt->execute();
        $userList = $stmt->fetchAll();
        return $userList;
    }

    public function getUsersByEmailAndPassword($userEmail, $userPassword)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `email` =  ? AND `password` = ?" );
        $stmt->bindParam(1, $userEmail);
        $stmt->bindParam(2, md5($userPassword));
        $stmt->execute();
        $userList = $stmt->fetchAll();
        return $userList;
    }

    public function insertNewUser($userName, $userEmail, $userPassword)
    {
        $userPassword = md5($userPassword);
        $role = "User";
        $stmt = $this->pdo->prepare("INSERT INTO `user` (`firstname`, `email`, `password`, `date_created`, `role`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $userName);
        $stmt->bindParam(2, $userEmail);
        $stmt->bindParam(3, $userPassword);
        $stmt->bindParam(4, time());
        $stmt->bindParam(5, $role);
        $result = $stmt->execute();
        return $result;
    }

    public function checkUserIsExist($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `id` = ?" );
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $userList = $stmt->fetchAll();
        if (empty($userList)) {
            return false;
        } else {
            return true;
        }
    }

    public function insertSession($sessionId, $userId, $expirationTime)
    {
        $stmt = $this->pdo->prepare("INSERT INTO `user_sessions` (`session_id`, `user_id`, `expiration_time`) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $sessionId);
        $stmt->bindParam(2, $userId);
        $stmt->bindParam(3, $expirationTime);
        $result = $stmt->execute();
        return $result;
    }

    public function getUserBySessionId($sessionId)
    {
        $stmt = $this->pdo->prepare("SELECT `user`.`id`, `user`.`firstname`, `user`.`email`, `user`.`date_created`, `user`.`role` FROM `user` LEFT JOIN `user_sessions` ON `user`.`id`=`user_sessions`.`user_id` WHERE `user_sessions`.`session_id`=?" );
        $stmt->bindParam(1, $sessionId);
        $stmt->execute();
        $userList = $stmt->fetchAll(2);
        return $userList;
    }
}