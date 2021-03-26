<?php
namespace MikhailovIgor\Lib;

class ResponseToFrontEnd{

    private $errors = [];

    private $messages = [];
 
    public function __construct()
    {

    }

    public function addError(String $errorCode, String $errorMessage)
    {
        $errorCode = trim($errorCode);
        $errorMessage = trim($errorMessage);
        if ($errorCode == "") {
            return false;
        } else {
            $this->errors[$errorCode] = $errorMessage;
            return $this;
        }
    }

    public function addMessage(String $messageCode, String $messageMessage)
    {
        $messageCode = trim($messageCode);
        $messageMessage = trim($messageMessage);
        if ($messageCode == "") {
            return false;
        } else {
            $this->messages[$messageCode] = $messageMessage;
            return $this;
        }
    }

    public function sendJSON()
    {
        $json["errors"] = $this->errors;
        $json["messages"] = $this->messages;
        echo json_encode($json);
        return $this;
    }

}
