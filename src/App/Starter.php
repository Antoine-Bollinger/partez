<?php 
/*
 * This file is part of the Partez package.
 *
 * (c) Antoine Bollinger <abollinger@partez.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Partez\App;

use \Partez\Config\Bootstrap;
use \Partez\Router\Router;
use \Abollinger\Session;

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