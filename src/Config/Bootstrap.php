<?php 
namespace Partez\Config;

use \Abollinger\Helpers;

/**
 * Class Bootstrap
 * Handles the initialization and setup of main application variables and loads environment variables from the .env file.
 */
final class Bootstrap
{
    /**
     * This function sets the main variables used in the application and loads environment variables from the .env file.
     *
     * This function defines various constants used throughout the application, such as paths and URLs.
     * It also loads environment variables from the .env file using Dotenv library.
     * If the APP_ENV is set to 'dev', it resets the OPCache.
     *
     * @return void
     */
    static public function setEnvironment(

    ) :void {
        Helpers::defineConstants([
            "APP_ROOT" => str_replace("\\", "/", dirname(dirname(__DIR__)))
        ]);

        try {
            $dotenv = \Dotenv\Dotenv::createImmutable(APP_ROOT);
            $dotenv->load();
        } catch(\Exception $e) {
            error_log("🚨 \e[33m" . $e->getMessage() . " Please create a .env at the root of the project. See .env-example.\e[39m");
        }

        Helpers::defineConstants([
            "APP_SUBDIR" => Helpers::getAppSubdirectory(APP_ROOT, $_SERVER["DOCUMENT_ROOT"]),
            "APP_CONFIG" => APP_ROOT . "/src/Config",
            "APP_CONTROLLER" => APP_ROOT . "/src/Controller",
            "APP_VIEW" => APP_ROOT . "/view"
        ]);
       
        if (isset($_ENV["APP_ENV"]) && $_ENV["APP_ENV"] === "dev")
            opcache_reset();

        Helpers::defineConstants([
            "APP_TITLE" => $_ENV["APP_TITLE"] ?? "title"
        ]);
	}
}