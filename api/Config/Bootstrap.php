<?php
namespace Partez\Api\Config;

use \Abollinger\Helpers;

/**
 * Class Bootstrap
 *
 * The Bootstrap class handles the configuration setup for the API environment.
 * It defines essential constants and loads environment variables from the .env file.
 */
final class Bootstrap
{
    /**
     * Sets the environment variables and defines constants for API configuration.
     * 
     * This function sets up environment variables using a .env file and defines
     * constants for API-related configurations like API_ROOT, API_ROUTES, ALLOW_ORIGIN,
     * and ALLOW_METHODS.
     */
    static public function setEnv(

    ) :void {
        Helpers::defineConstants([
            "API_ROOT" => str_replace("\\", "/", dirname(__DIR__))
        ]);

        try {
            $dotenv = \Dotenv\Dotenv::createImmutable(dirname(API_ROOT));
            $dotenv->load();
        } catch(\Exception $e) {
            error_log("🚨 \e[33m" . $e->getMessage() . " Please create a .env at the root of the project. See .env-example.\e[39m");
        }
        
        Helpers::defineConstants([
            "APP_SUBDIR" => Helpers::getAppSubdirectory(dirname(API_ROOT), $_SERVER["DOCUMENT_ROOT"]),
            "API_ROUTES" => API_ROOT . "/Router/routes",
            "ALLOW_ORIGIN" => $_ENV["ALLOW_ORIGIN"] ?? "*",
            "ALLOW_METHODS" => $_ENV["ALLOW_METHODS"] ?? "GET, POST, PUT, DELETE"
        ]);
    }
}