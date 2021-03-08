<?php
namespace MikhailovIgor\Lib;

use Exception;

class Logger
{
    private static $pathToLogFile = "\log.txt";
    private static $classLoader = NULL;
    private static $logLevel;

    private function __construct(){
    }

    public static function getInstance()
    {
        
        if (self::$classLoader === null) {
            self::$classLoader = new self();
        }

        return self::$classLoader;
    }

    public static function setPathToLogFile(String $pathToLogFile)
    {
        if (!self::verifyPathToLogFile($pathToLogFile)) {
            throw new Exception("Ошибка при отрытии файла логирования! Возможно указан неверный путь к файлу");
        } else {
            self::$pathToLogFile = $pathToLogFile;
        }
    }

    private static function verifyPathToLogFile($pathToLogFile)
    {
        $file = fopen($pathToLogFile, "a+");
        if ($file) {
            fclose($file);
            return true;
        } else {
            return false;
        }
    }

    public static function createLog(String $textLog)
    {
        $timeNow = date("d-m-Y H:m:s");
        $file = fopen(self::$pathToLogFile, "a+");
        $strToLog = (self::$logLevel ? (self::$logLevel . " >>> ") : "") . $timeNow . " >>> " . $textLog . "\n";
        fwrite($file, $strToLog);
        fclose($file);
    }

    public static function setLogLevelFatal()
    {
        self::$logLevel = "FATAL";
    }

    public static function setLogLevelInfo()
    {
        self::$logLevel = "INFO";
    }

    public static function setLogLevelWarning()
    {
        self::$logLevel = "WARNING";
    }
}
