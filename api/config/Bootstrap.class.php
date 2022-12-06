<?php 
namespace Abollinger\PHPStarter\Api;

abstract class Bootstrap 
{
    /**
     * Set the constants for the all app
     * 
     * @param null
     * @return boolean
     */
    static public function setConstants(
        $params = null
    ) : bool {
        // API paths
        define("API_ROOT", str_replace("\\", "/", dirname(__DIR__)));
        define("API_SUBDIR", str_replace(str_replace("\\", "/",$_SERVER["DOCUMENT_ROOT"]), "", API_ROOT));
        define("API_MODEL_PATH", API_ROOT . "/model");
        define("API_CONTROLLER_PATH", API_ROOT . "/controller"); 
        define("API_ROUTER_PATH", API_ROOT . "/router");


        // DATABASE CONSTANTS
        define("DB_HOST", "localhost");
        define("DB_USERNAME", "root");
        define("DB_PASSWORD", "");
        define("DB_DATABASE", "partezdb");
        return true;
    }
}

Bootstrap::setConstants();