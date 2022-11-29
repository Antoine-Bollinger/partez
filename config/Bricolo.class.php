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
        echo "Creating a new page named " . $params[0];
        $routes = file_get_contents(APP_ROOT . "/src/Router/routes.yaml");
        file_put_contents(APP_ROOT . "/src/Router/routes.yaml", $routes . "
- route: \"/".$params[0]."\"
  name: \"".ucfirst($params[0])."\"
  path: \"".ucfirst($params[0])."\"
  controller: \"".ucfirst($params[0])."Controller\"
        ");
    }

}

new Bricolo($argc, $argv);