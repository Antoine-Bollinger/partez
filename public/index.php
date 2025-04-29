<?php 
//======================================================================
// WELCOME TO PARTEZ!
//======================================================================

namespace Partez;

// Include Composer's autoloader
require_once dirname(__DIR__) . "/vendor/autoload.php";

use \Abollinger\Helpers;

/**
 * The Kernel class initializes the application based on the requested URL.
 *
 * It determines whether the requested URL begins with "/api/" and then
 * instantiates the appropriate Starter class accordingly.
 */
class Kernel
{
    /**
     * Kernel constructor.
     *
     * This constructor initializes the application by determining the subdirectory
     * path and the requested URL. It then instantiates the appropriate Starter class
     * based on whether the URL starts with "/api/" or not.
     */
    public function __construct(

    ) {
        $url = str_replace(
            Helpers::getAppSubdirectory(dirname(__DIR__), $_SERVER["DOCUMENT_ROOT"]), 
            "", 
            $_SERVER["REQUEST_URI"]
        );

        strpos($url, "/api/") === 0 
            ? new Api\Starter()
            : new App\Starter();
    }
}

// Instantiate the Kernel to start the application
new Kernel();
