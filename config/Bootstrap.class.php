<?php
namespace Abollinger\StarterPhp\Config;

abstract class Bootstrap 
{
    static public function setConstants(
        $params = null
    ) {
        define("APP_ROOT", dirname(__DIR__));
        define("APP_MODEL_PATH", APP_ROOT . "/src/Model");
        define("APP_CONTROLLER_PATH", APP_ROOT . "/src/Controller"); 
        define("APP_ROUTER_PATH", APP_ROOT . "/src/Router"); 
    }
}
