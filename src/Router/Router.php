<?php 
namespace Partez\Router;

use \Partez\Abstract;
use \Partez\Controller\ErrorController;

use \Abollinger\Helpers;
use \Abollinger\Session;

/**
 * Class AppRouter
 *
 * Manages routing for the application, finds and renders requested routes, and handles error scenarios.
 */
final class Router extends \Abollinger\Router 
{        
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
        private array $params = []
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
        $this->requestedRoute = $this->getRequestedRoute($this->params["url"], APP_SUBDIR);
        $this->routes = $this->getRoutesFromDirectory(APP_CONTROLLER, "\Partez");
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
            if ($this->route["auth"] && !$this->session->isLoggedAndAuthorized(true))
                throw new \Exception("auth", 401);
            new $this->route["controller"](array_merge($this->route, [
                "routes" => $this->routes,
                "auth" => $this->session->isLoggedAndAuthorized(true)
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