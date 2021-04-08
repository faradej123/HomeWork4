<?php
namespace MikhailovIgor\Lib;

class ResponseToFrontEnd {

    private $errors = [];
    private $messages = [];
    private $data = [];
 
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
            return TRUE;
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
            return TRUE;
        }
    }

    public function addData(String $dataCode, String $dataMessage)
    {
        $dataCode = trim($dataCode);
        $dataMessage = trim($dataMessage);
        if ($dataCode == "") {
            return false;
        } else {
            $this->data[$dataCode] = $dataMessage;
            return TRUE;
        }
    }

    public function sendJSON()
    {
        $json["errors"] = $this->errors;
        $json["messages"] = $this->messages;
        $json["data"] = $this->data;
        echo json_encode($json);
        return TRUE;
    }

}
