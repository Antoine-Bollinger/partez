<?php 
namespace Abollinger\Partez\Abstract;

use \Abollinger\Helpers;
use \Abollinger\Parsedown;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
use \Twig\Extra\Html\HtmlExtension;
use \Twig\Extra\Intl\IntlExtension;
use \Twig\Extension\DebugExtension;

/**
 * Abstract class Controller.
 *
 * The base abstract class for controllers providing common functionality such as
 * setting up Twig environment, rendering HTML pages, Markdown files, YAML files, and directory scans.
 * Controllers extending this class can use these shared methods for rendering various content.
 */
abstract class Controller implements Initializer\Controller
{
    private $twig;
    public $params;

    /**
     * Constructor for the class.
     *
     * This constructor initializes the object by setting provided parameters,
     * configuring the Twig environment, and invoking the `init` method if it exists.
     *
     * @param mixed|null $params Parameters passed to the constructor (default: null)
     */
    public function __construct(
        $params = null
    ) {
        $this->params = $params;
        $this->setTwig();
        $this->init();
    }

    /**
     * Sets up the Twig environment for rendering templates.
     *
     * This method initializes the Twig environment by configuring a FilesystemLoader,
     * setting up various options like caching and debugging, adding extensions,
     * and defining global variables available within Twig templates.
     *
     * @param bool|string $cache Indicates whether Twig should use caching for templates (default: false)
     * @return bool Returns true on successful setup of Twig environment, otherwise false
     */
    private function setTwig(
        $cache = false
    ) :bool {
        $loader = new FilesystemLoader(APP_VIEW);
        $this->twig = new Environment($loader, [
            "cache" => $cache,
            "debug" => true
        ]);
        $this->twig->addExtension(new HtmlExtension());
        $this->twig->addExtension(new DebugExtension());
        $this->twig->addExtension(new IntlExtension());
        $this->twig->addGlobal("app_title", APP_TITLE);
        $this->twig->addGlobal("_params", $this->params);
        $this->twig->addGlobal("_session", $_SESSION);
        return true;
    }

    /**
     * Render a HTML view based on twig's templates. 
     * 
     * @param string $file  Name of the twig file to be rendered
     * @param array $params An array of variables passes to the twig template
     * @return bool
     */
    public function renderPage(
        $file = "",
        $params = []
    ) :bool {
        try {
            if (!file_exists(APP_VIEW . "/pages/" . $file)) {
                throw new \Exception("view", 500);
            }
			echo $this->twig->render("pages/" . $file, $params);
            return true;
        } catch(Exception $e) {
			throw new \Exception($e);
            return false;
		}
    }

    /**
     * Public function to render a Markdown written file. Based on erusev/parsedown package that is extended in shared/Parsedown.php file.
     * 
     * @param string $file  Name of the Markdown file to be read
     * @return string|bool  Return a HTML string of the file or false if an error occured.
     */
    public function renderMd(
		$file = ""
	) :string|bool {
        try {
            if (!file_exists($file)) {
                throw new \Exception("file", 500);
            }
            $text = file_get_contents($file);
            $text = str_replace("public/", "./", $text);
            $Parsedown = new Parsedown();
            return $Parsedown->text($text);
        } catch(Exception $e) {
			throw new \Exception($e);
            return false;
		}
	}

    /**
     * Public function to render a Yaml written file as a HTML list. Based on Helpers::getYaml & Helpers::printArray functions.
     * 
     * @param string $file      Name of the Markdown file to be read
     * @return string|bool   Return a HTML string of the file or false if an error occured.
     */
    public function renderYaml(
        $file = ""
    ) :string|bool {
        try {
            if (!file_exists($file)) {
                throw new \Exception("file", 500);
            }
            $text = Helpers::getYaml($file);
            return Helpers::printArray($text);
        } catch(Exception $e) {
			throw new \Exception($e);
            return false;
		}
    }

    /**
     * Public function to render a directoryu Scan as an HTML list. Based on Helpers::getYaml & Helpers::printArray functions.
     * 
     * @param string $file      Name of the Markdown file to be read
     * @return string|bool   Return a HTML string of the file or false if an error occured.
     */
    public function renderScan(
        $file = "",
        $root = ""
    ) :string|bool {
        try {
            if (!file_exists($file)) {
                throw new \Exception("file", 500);
            }
            $text = Helpers::getScan($file, $root);
            return Helpers::printArray($text);
        } catch(Exception $e) {
			throw new \Exception($e);
            return false;
		}
    }
}
