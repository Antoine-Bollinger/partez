<?php 
namespace Abollinger\StarterPhp\Router;

use \Symfony\Component\Yaml\Yaml;
use \Abollinger\StarterPhp\Config\Helpers;
use \Abollinger\StarterPhp\Controller\Controller;

class Router 
{
    public $routes;
    public $route;
    public $controller;

    public function __construct(
        $params = null
    ) {
        $this->setRoutes();
    }

    /**
     * Set a array of the availables routes edited in the routes.yaml files
     * 
     * @param null
     * @return boolean true
     */
    private function setRoutes(
        $params = null
    ) {
        $this->routes = Yaml::parseFile(APP_ROOT . "/src/Router/routes.yaml");
        return true;
    }

    /**
     * Get the requested route, compare if it exists in the declared routes and, if so, set the right controller
     * 
     * @param null
     * @return boolean
     */
    public function setRoute(
        $params = null
    ) {
        try {
			$request_uri = str_replace(APP_SUBDIR, "", $_SERVER["REQUEST_URI"]);
			$main_url = explode("?", $request_uri, 2);
            $route = $main_url[0];
        
            $key = array_search($route, array_column($this->routes, "route"));
            if ($key === false) {
                throw new \Exception(sprintf("The page you're trying to get (%s) was not found.", $route), 404);
            }
            $this->route = $this->routes[$key];
            if (!file_exists(APP_CONTROLLER_PATH . "/" . $this->route["path"] . "/Controller.php")) {
                throw new \Exception("The controller you're trying to use doesn't exist.", 500);
            }            
            require_once APP_CONTROLLER_PATH . "/" . $this->route["path"] . "/Controller.php"; 
            $this->controller = "\\Abollinger\\StarterPhp\\Controller\\" . $this->route["controller"]; 
            new $this->controller(["route" => $this->route, "routes" => $this->routes]);
            return true;
        } catch (\Exception $e) {
            $error = new Controller([
                "message" => $e->getMessage(), 
                "code" => $e->getCode(), 
                "routes" => $this->routes, 
                "route" => ["name" => "Error " . $e->getCode()]
            ]);
            $error->renderView("error.twig");
            return false;
        }
    }
}

return new Router();