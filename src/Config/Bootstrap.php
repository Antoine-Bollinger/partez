<?php 
/*
 * This file is part of the Partez package.
 *
 * (c) Antoine Bollinger <abollinger@partez.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
            "APP_CONTROLLERS" => APP_ROOT . "/src/Controllers",
            "APP_VIEWS" => APP_ROOT . "/views"
        ]);
       
        if (isset($_ENV["APP_ENV"]) && $_ENV["APP_ENV"] === "dev")
            opcache_reset();

        Helpers::defineConstants([
            "APP_TITLE" => $_ENV["APP_TITLE"] ?? "title"
        ]);
	}
}