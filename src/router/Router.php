<?php 
namespace Abollinger\Partez\Router;

use \Abollinger\Partez\Abstract;
use \Abollinger\Partez\Config\Session;
use \Abollinger\Partez\Controller\ErrorController;

use \Abollinger\Helpers;
use \Abollinger\RouteReader;

/**
 * Class AppRouter
 *
 * Manages routing for the application, finds and renders requested routes, and handles error scenarios.
 */
final class Router extends Abstract\Router 
{
    /** @var array $params Parameters for the router. */
    private $params;

        
    /** @var Session $session Session object for handling user sessions. */
    private $session;

    /**
     * Constructor for the AppRouter class.
     *
     * Initializes the router by setting parameters, determining the requested route, fetching routes,
     * and executing the router's initialization and rendering methods.
     *
     * @param array $params Parameters passed to the router (default: [])
     */
    public function __construct(
        $params = []
    ) {
        $this->params = Helpers::defaultParams([
            "url" => parse_url($_SERVER["REQUEST_URI"])["path"]
        ], $params);
        $this->session = new Session(); 
        $this->init();
        $this->render();
    }

    /**
     * Initializes the AppRouter by setting up the requested route and fetching available routes.
     *
     * @return void
     */
    public function init(

    ) :void {
        $this->requestedRoute = $this->getRequestedRoute($this->params["url"]);
        $reader = new RouteReader();
        $this->routes = $reader->getRoutesFromDirectory(APP_CONTROLLER, "Abollinger\\Partez");       
        $this->route = $this->findMatchingRoute($this->routes, $this->requestedRoute);
    }

    /**
     * Renders the requested route or handles exceptions by invoking the ErrorController.
     *
     * Creates an instance of the requested controller based on the matched route or handles exceptions
     * by instantiating the ErrorController with appropriate error details.
     *
     * @return void
     */
    public function render(

    ) :void {
        try {
            if (!is_array($this->route) || count($this->route) === 0)
                throw new \Exception("page", 404);
            if (!class_exists($this->route["controller"]))
                throw new \Exception("controller", 500);
            if ($this->route["auth"] && !$this->session->isLoggedAndAuthorized())
                throw new \Exception("auth", 401);
            new $this->route["controller"](array_merge($this->route, [
                "routes" => $this->routes,
                "auth" => $this->session->isLoggedAndAuthorized()
            ]));
        } catch(\Exception $e) {
            new ErrorController([
                "code" => $e->getCode(),
                "message" => $e->getMessage(),
                "name" => "Error " . $e->getCode(),
                "route" => $this->requestedRoute,
                "routes" => $this->routes
            ]);
        }
    }
}