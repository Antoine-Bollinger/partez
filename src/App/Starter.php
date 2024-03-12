<?php 
namespace Partez\App;

use \Partez\Config\Bootstrap;
use \Abollinger\Session;
use \Partez\Router\Router;

/**
 * Class Starter
 *
 * The Starter class initializes essential components for the application to run.
 * It starts the session, sets the environment using Bootstrap, and triggers the application router.
 */
final class Starter 
{
    /**
     * Constructor for the Starter class.
     *
     * Initializes necessary components to start the application.
     *
     * - Starts the session using Session::start().
     * - Sets the environment configuration using Bootstrap::setEnvironment().
     * - Initializes and triggers the application router (Router).
     */
    public function __construct(

    ) {
        Bootstrap::setEnvironment();
        new Session();
        new Router();
    }
}