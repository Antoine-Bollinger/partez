<?php 
namespace Partez\Api\Router;

use \Partez\Abstract;
use \Partez\Api\View\Response;

use \Abollinger\Session;
use \Abollinger\Helpers;
use \Abollinger\RouteReader;

/**
 * Class Router
 *
 * Handles routing for the API, authorizes access, and executes controller methods based on routes and HTTP verbs.
 */
final class Router extends \Abollinger\Router
{
    /** @var array $params Parameters for the API router. */
    private $params;
    
    /** @var Session $session Session object for handling user sessions. */
    private $session;
    
    /** @var Response $view Response object for managing API responses. */
    private $view;

    /**
     * Constructor for the Router class.
     *
     * Initializes the router by setting parameters, determining the requested route, fetching routes,
     * initializing session and response view, and executing the router's initialization and rendering methods.
     *
     * @param array $params Parameters passed to the router (default: [])
     */
    public function __construct(
        $params = []
    ) {
        $this->params = Helpers::defaultParams([
            "url" => parse_url($_SERVER["REQUEST_URI"])["path"],
            "verb" => $_SERVER["REQUEST_METHOD"],
            "isSameServer" => false
        ], $params);
        $this->requestedRoute = $this->getRequestedRoute($this->params["url"], APP_SUBDIR);
        $this->routes = $this->getRoutesFromYaml(API_ROUTES);
        $this->route = $this->findMatchingRoute($this->routes, $this->requestedRoute);
        $this->session = new Session(); 
        $this->view = new Response();
        $this->init();
        $this->render();
    }

    /**
     * Initializes the API router by validating the route, authentication, and HTTP verb.
     *
     * Handles different scenarios such as route not found, unauthorized access, or incorrect verb.
     *
     * @return void
     */
    public function init(

    ) :void {
        if (!is_array($this->route) || count($this->route) === 0) {            
            $this->view->set([
                "code" => 404,
                "success" => false,
                "message" => "🔥 Bad Request, the route you're requiring doesn't exist. 🔥"
            ]);
            return;
        }
        if (!$this->checkAuth()) {
            $this->view->set([
                "code" => 401,
                "success" => false,
                "message" => "🔥 You're not allowed to access this api. Please login first. 🔥"
            ]);
            return;
        }
        if (!$this->checkVerb($this->route, $this->params["verb"])) {
            $this->view->set([
                "code" => 405,
                "success" => false,
                "message" => "🔥 Bad Request, the route you're requiring exists but the method (verb) is not correct. 🔥",
                "data" => ["Allow" => ALLOW_METHODS]
            ]);
            return;
        }
        try {
            $tmp = explode("::", $this->route["controller"]);
            $className = $tmp[0];
            $method = $tmp[1];
            $controller = new $className();
            $response = $controller->{$method}($this->route["params"]);
            $this->view->set($response);
        } catch(\Exception $e) {
            $this->view->set([
                "code" => 500,
                "success" => false,
                "message" => "🔥 An error occured, here is the message: " . $e->getMessage() . " 🔥"
            ]);
        }
    }

    /**
     * Renders the API response based on the configured parameters.
     *
     * Sends the response in JSON format if not on the same server, otherwise returns the response array.
     *
     * @return array|null Returns the response array or null if not on the same server
     */
    public function render(

    ) :array|null {
        if ($this->params["isSameServer"])
            return $this->view->get();
        else 
            $this->view->sendJSON();
            exit;
    }

    /**
     * Checks if the provided HTTP verb matches the route's configured verb.
     *
     * @param array $route The route to check against
     * @param string $verb The HTTP verb to compare
     * @return bool Returns true if the verbs match, otherwise false
     */
    private function checkVerb(
        $route = [],
        $verb = ""
    ) :bool {
        try {
            return is_array($route) && strcasecmp($route["verb"], $verb) === 0;
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
     * Checks the authorization status based on the route's authentication property and session state.
     *
     * @return bool Returns true if authorized, otherwise false
     */
    private function checkAuth(

    ) :bool {
        return (isset($this->route["auth"]) && $this->route["auth"] === true) 
            ? $this->session->isLoggedAndAuthorized($this->params["isSameServer"]) 
            : true;
    }
}