<?php 
namespace Partez\Abstract;

/**
 * Abstract class Router
 *
 * Base abstract class defining common functionalities for routing.
 * Child classes should implement the interface Initializer\Router and provide
 * specific implementations for routing-related operations.
 */
abstract class Router implements Initializer\Router
{
    /**
     * @var string $requestedRoute The requested route obtained from the URL
     */
    protected $requestedRoute;

    /**
     * @var array $routes Collection of routes defined for the application
     */
    protected $routes;

    /**
     * @var array $route Information about the current matched route
     */
    protected $route;

    /**
     * Obtains the requested route from the provided URI.
     *
     * @param string $uri The URI string
     * @return string The sanitized requested route
     */
    protected function getRequestedRoute(
        $uri = ""
    ) :string {
        return str_replace(APP_SUBDIR, "", ($uri !== "/" && substr($uri, -1) === "/") ? rtrim($uri) : $uri);
    }
    
    /**
     * Finds a matching route based on the provided routes and route string.
     *
     * @param array $routes Collection of routes to search within
     * @param string $route The route string to match
     * @return array Information about the matching route, if found
     */
    protected function findMatchingRoute(
        $routes = [],
        $route = ""
    ) :array {
        try {
            if (!is_array($routes)) return [];
            $tmp = array_values(array_filter($routes, function($v) use ($route) {
                return $v["path"] === $route;
            }));
            return count($tmp) === 1 ? $tmp[0] : [];
        } catch(\Exception $e) {
            return [];
        }
    }
}