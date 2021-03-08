<?php
namespace Core;

class Router{

    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function register(){
        $routes = require_once ("Core/configs/router.php");

        $segments = explode("?", $_SERVER["REQUEST_URI"]);
        $segmentsStr = trim($segments[0], "/");

        foreach($routes as $patternUrl => $route){
            if(isset($route[$_SERVER["REQUEST_METHOD"]])&& preg_match("#^".$patternUrl."$#", $segmentsStr)) {

                $route = $route[$_SERVER["REQUEST_METHOD"]];
                $params = $route["params"];

                if(strpos($params, "$") !== false){
                    $params = preg_replace("#^".$patternUrl."$#", $params, $segmentsStr); // 12/43
                    $params = explode("/", $params);
                }else {
                    $params = [];
                }

                $controller = $route["controller"];
                $action = $route["action"];

                $object = new $controller();

                call_user_func_array([$object, $action], $params);

                return;
            }
        }

        //TODO: show 404 page
    }

    private function __sleep()
    {

    }

    private function __wakeup()
    {

    }
}
/*class Router{

    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function register(){
        $routes = require_once ($_SERVER["CONTEXT_DOCUMENT_ROOT"] . "/Core/configs/router.php");

        $requestUri = $_SERVER["REQUEST_URI"];
        $method = $_SERVER["REQUEST_METHOD"];

        if(isset($routes[$requestUri][$method])){
            $route = $routes[$requestUri][$method];
            $controller = $route["controller"];
            $action = $route["action"];

            $object = new $controller();
            $object->$action();
        }else{
            //TODO: show 404 page
        }
    }

    private function __sleep()
    {

    }

    private function __wakeup()
    {

    }
}*/