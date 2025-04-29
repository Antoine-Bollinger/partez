<?php 
namespace Partez\Api;

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

use \Partez\Api\Config\Bootstrap;
use \Partez\Api\Router\Router;

/**
 * Class Starter
 *
 * The Starter class initializes the API environment and triggers API routing and response handling.
 * It serves as the entry point for the API, setting up the environment, initializing the router,
 * and obtaining the API response.
 */
final class Starter 
{
    /** @var Router $router An instance of the Router class for managing API routes and requests. */
    private Router $router;

    /** @var mixed $response Holds the API response obtained from the router. */
    private mixed $response;

    /**
     * Constructor for the Starter class.
     *
     * Initializes the API environment, sets up the router, and obtains the API response.
     *
     * @param array $params Parameters passed to the constructor (default: [])
     */
    public function __construct(
        $params = []
    ) {
        Bootstrap::setEnv();
        $this->router = new Router($params);
        $this->response = $this->router->render();
    }

    /**
     * Retrieves the API response.
     *
     * @return mixed Returns the API response obtained from the router.
     */
    public function get(

    ) :mixed {
        return $this->response;
    }
}