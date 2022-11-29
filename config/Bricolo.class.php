<?php
namespace Abollinger\StarterPhp\Config;

define("APP_ROOT", dirname(__DIR__));

class Bricolo
{
    private $method;
    private $params;

    public function __construct(
        $argc,
        $argv
    ) {
        try {
            if (!$argc || $argc < 3) {
                throw new \Exception('No argument. Please pass argument.');
            }
            array_shift($argv);
            $this->method = array_shift($argv);
            $this->params = $argv ?? [];
            if (!method_exists($this, $this->method)) {
                throw new \Exception('The method '.$this->method.' does not exist.');
            }
            $this->{$this->method}($this->params);
        } catch (\Exception $e) {
            echo $e->getMessage();
        } 
    }

    private function addpage(
        $params = []
    ) {
        try {
            if ($params[0] === "") {
                throw new Exception("Please give a name to your page");
            }
            $ucName = ucfirst($params[0]);
            $name = strtolower($params[0]);

            $controllerPath = APP_ROOT . "/src/Controller/" . $ucName;
            $modelPath = APP_ROOT . "/src/Model/views/" . $name . ".twig";
            
            echo "Creating a new page named " . $ucName;
            $routes = file_get_contents(APP_ROOT . "/src/Router/routes.yaml");
            file_put_contents(APP_ROOT . "/src/Router/routes.yaml", $routes . "
- route: \"/".$name."\"
  name: \"".$ucName."\"
  path: \"".$ucName."\"
  controller: \"".$ucName."Controller\"
            ");
            mkdir($controllerPath);
            copy(APP_ROOT . "/config/templates/Controller.php", $controllerPath . "/Controller.php");
            copy(APP_ROOT . "/config/templates/new.twig", $modelPath);
            file_put_contents($controllerPath . "/Controller.php", "<?php 
namespace Abollinger\StarterPhp\Controller;

class ".$ucName."Controller extends Controller
{
    public function __construct(
        \$params = null
    ) {
        parent::__construct(\$params);
        \$this->renderView(\"".$name.".twig\");
    }
}
            ");
            echo "Pages created! Please edit " . $controllerPath . "/Controller.php" . " and " . $modelPath . " to configure you're new page.";
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        } 
    }
}

new Bricolo($argc, $argv);