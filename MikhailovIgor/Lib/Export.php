<?php
namespace MikhailovIgor\Lib;
use MikhailovIgor\Lib\Logger;
use Exception;

class Export {

    public static $logger;

    private function __construct()
    {
        
    }

    protected static function sendFileToDownload(String $fileName, String $strToFile)
    {
        $filePath = tempnam(sys_get_temp_dir(), 'tmp');
        $file = fopen($filePath, "w+");
        if (!$file) {
            throw new Exception("Ошибка при открытии временного файла");
        }
        $fileSize = fwrite($file, $strToFile);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream; charset=CP-866');
        header('Content-Disposition: attachment; filename=' . $fileName);
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . $fileSize);
        if (!readfile($filePath)) {
            throw new Exception("Ошибка при чтении из временного файла");
        }
        fclose($file);
        unlink($filePath);
        return true;
    }
}