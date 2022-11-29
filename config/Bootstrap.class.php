<?php
namespace Abollinger\StarterPhp\Config;

/**
 * Bootstrap for the web app
 * 
 * Abstract class that allow to define the constants for the app
 */
abstract class Bootstrap 
{

    /**
     * Set the constants for the all app
     * 
     * @return boolean
     */
    static public function setConstants(
        $params = null
    ) {
        define("APP_ROOT", str_replace("\\", "/", dirname(__DIR__)));
        define("APP_SUBDIR", str_replace(str_replace("\\", "/",$_SERVER["DOCUMENT_ROOT"]), "", APP_ROOT));
        define("APP_MODEL_PATH", APP_ROOT . "/src/Model");
        define("APP_CONTROLLER_PATH", APP_ROOT . "/src/Controller"); 
        define("APP_ROUTER_PATH", APP_ROOT . "/src/Router");
        return true;
    }

    /**
     * Set sub-directory in .htaccess for Apache server (useless when running php -S)
     * 
     * @param string $app_root Root of the app server
     * @param string app_subdir Sub-directory when app is not on the server root
     * 
     * @return boolean  
     */
    static public function setHtaccess(
		$app_root = "",
		$app_subdir = ""
	) {
		$fp = fopen($app_root . "/.htaccess", "w");
		fwrite($fp, "RewriteEngine On
RewriteCond %{REQUEST_URI} !^".$app_subdir."/public [NC]
RewriteRule . index.php [L,QSA]");
		fclose($fp);
        return true;
	}
}
