<?php
namespace Core;

class ClassLoader
{

    private static $classLoader;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (self::$classLoader === null) {
            self::$classLoader = new self();
        }

        return self::$classLoader;
    }

    public function register()
    {
        spl_autoload_register([self::$classLoader, "load"], true, true);
    }

    public function load($class)
    {
        $class = str_replace("\\", "/", $class);
        require_once($_SERVER["CONTEXT_DOCUMENT_ROOT"] . "/" . $class . ".php");
    }

    private function __sleep()
    {

    }

    private function __wakeup()
    {

    }
}