<?php 
namespace Abollinger\PHPStarter\Router;

use \Abollinger\PHPStarter\Config\Helpers;

require_once APP_ROOT . "/config/Router.class.php";

class ApiRouter extends Router
{
    public function __construct(
        $path = "",
        $routes = "",
        $texts = ""
    ) {
        parent::__construct($path, $routes, $texts);
    }

    public function start(
        $params = null
    ) : bool {
        try {
            $tmp = explode("/", $this->path);
            if (count($tmp) > 0)
                array_shift($tmp);
            if (count($tmp) === 0 || !isset($this->routes["/" . $tmp[0]]))
                throw new \Exception("Cannot GET " . API_SUBDIR . $this->path, 404);
            $this->route = $this->routes["/" . $tmp[0]];
            if (!isset($this->route["/" . $tmp[1]]))
                throw new \Exception("Cannot GET " . API_SUBDIR . $this->path, 403);
            echo json_encode([
                "path" => $this->path,
                "route" => $this->route["/" . $tmp[1]],
                "_get" => $_GET, 
                "_post" => $_POST
            ]);
            return true;
        } catch (\Exception $e) {
            http_response_code($e->getCode());
            $title = "Error " . $e->getCode();
            $content = $e->getMessage();
            require_once API_ROOT . "/config/error.php";
            return false;
        }
    }
}