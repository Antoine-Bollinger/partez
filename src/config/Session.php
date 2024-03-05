<?php
namespace Abollinger\Partez\Config;

/**
 * Class session
 * Handles session initiation and management.
 */
final class Session
{
    /**
     * This function starts or resumes a session if not already active.
     * 
     * @return void
     */
    public static function start(

    ) :void {
        if (session_status() !== PHP_SESSION_ACTIVE) 
            session_start();
    }

    public function isLoggedAndAuthorized(

    ) :bool {   
        return (isset($_SESSION["userId"]) && isset($_SESSION["token"]));
    }
}
