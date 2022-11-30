<?php
namespace Abollinger\PHPStarter\Config;

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
            mkdir($controllerPath);
            copy(APP_ROOT . "/config/templates/Controller.php", $controllerPath . "/Controller.php");
            echo "Pages created! Please edit " . $controllerPath . "/Controller.php" . " and " . $modelPath . " to configure you're new page.";
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        } 
    }
}

new Bricolo($argc, $argv);