<?php 
/*
 * This file is part of the Partez package.
 *
 * (c) Antoine Bollinger <abollinger@partez.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Partez\Abstract;

use \Abollinger\Helpers;
use \Abollinger\Parsedown;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
use \Twig\Extra\Html\HtmlExtension;
use \Twig\Extra\Intl\IntlExtension;
use \Twig\Extension\DebugExtension;
use \Partez\Abstract\Twig\AppExtension;

/**
 * Abstract class Controller.
 *
 * The base abstract class for controllers providing common functionality such as
 * setting up Twig environment, rendering HTML pages, Markdown files, YAML files, and directory scans.
 * Controllers extending this class can use these shared methods for rendering various content.
 */
abstract class Controller implements Initializer\Controller
{
    /** @var Environment $twig */
    private Environment $twig;

    /** @var array Error messages */
    protected array $errorMessages = [];
    
    /** @var array Available error pages */
    protected array $availableErrorPages = [];

    /**
     * Constructor for the class.
     *
     * This constructor initializes the object by setting provided parameters,
     * configuring the Twig environment, and invoking the `init` method if it exists.
     *
     * @param mixed|null $params Parameters passed to the constructor (default: null)
     */
    public function __construct(
        public mixed $params = null
    ) {
        $this->setTwig();
        $this->setAvailableErrorPages();
        $this->setErrorMessages();
        // $this->init();
    }

    /**
     * Sets up the Twig environment for rendering templates.
     *
     * This method initializes the Twig environment by configuring a FilesystemLoader,
     * setting up various options like caching and debugging, adding extensions,
     * and defining global variables available within Twig templates.
     *
     * @param bool|string $cache Indicates whether Twig should use caching for templates (default: false)
     * 
     * @return bool Returns true on successful setup of Twig environment, otherwise false
     */
    private function setTwig(
        bool $cache = false
    ) :bool {
        $loader = new FilesystemLoader(APP_VIEWS);
        $this->twig = new Environment($loader, [
            "cache" => $cache,
            "debug" => true
        ]);
        $this->twig->addExtension(new HtmlExtension());
        $this->twig->addExtension(new DebugExtension());
        $this->twig->addExtension(new IntlExtension());
        $this->twig->addExtension(new AppExtension());
        $this->twig->addGlobal("app_title", APP_TITLE);
        $this->twig->addGlobal("app_subdir", APP_SUBDIR);
        $this->twig->addGlobal("_params", $this->params);
        $this->twig->addGlobal("_session", $_SESSION);
        return true;
    }

    /**
     * Render a HTML view based on twig's templates. 
     * 
     * @param string $file  Name of the twig file to be rendered
     * @param array $params An array of variables passes to the twig template
     * 
     * @return bool
     * 
     * @throws \Exception
     */
    public function renderPage(
        string $file = "",
        array $params = []
    ) :bool {
        try {
            if (!file_exists(APP_VIEWS . "/pages/" . $file)) {
                throw new \Exception("view", 500);
            }
            echo str_replace(
                "href=\"#", 
                "href=\"" . ltrim(str_replace(APP_SUBDIR, "", $_SERVER["REQUEST_URI"]), "/") . "#",
                $this->twig->render("pages/" . $file, $params)
            );
            return true;
        } catch(\Exception $e) {
			throw $e;
		}
    }

    /**
     * Public function to render a Markdown written file. Based on erusev/parsedown package that is extended in shared/Parsedown.php file.
     * 
     * @param string $file  Name of the Markdown file to be read.
     * 
     * @return string|bool  Return a HTML string of the file or false if an error occured.
     * 
     * @throws \Exception
     */
    public function renderMd(
		string $file = ""
	) :string|bool {
        try {
            if (!file_exists($file)) {
                throw new \Exception("file", 500);
            }
            $text = file_get_contents($file);
            $text = str_replace("/public/", "", $text);
            $Parsedown = new Parsedown();
            return $Parsedown->text($text);
        } catch(\Exception $e) {
			throw $e;
		}
	}

    /**
     * Public function to render a Yaml written file as a HTML list. Based on Helpers::getYaml & Helpers::printArray functions.
     * 
     * @param string $file      Name of the Markdown file to be read
     * 
     * @return string|bool   Return a HTML string of the file or false if an error occured.
     * 
     * @throws \Exception
     */
    public function renderYaml(
        string $file = ""
    ) :string|bool {
        try {
            if (!file_exists($file)) {
                throw new \Exception("file", 500);
            }
            $text = Helpers::getYaml($file);
            return Helpers::printArray($text);
        } catch(\Exception $e) {
			throw $e;
		}
    }

    /**
     * Public function to render a directory Scan as an HTML list. Based on Helpers::getYaml & Helpers::printArray functions.
     * 
     * @param string $file      Name of the Markdown file to be read
     * @param string $root      Root
     * 
     * @return string|bool   Return a HTML string of the file or false if an error occured.
     * 
     * @throws \Exception
     */
    public function renderScan(
        string $file = "",
        string $root = ""
    ) :string|bool {
        try {
            if (!file_exists($file)) {
                throw new \Exception("file", 500);
            }
            $text = Helpers::getScan($file, $root);
            return Helpers::printArray($text);
        } catch(\Exception $e) {
			throw $e;
		}
    }

    /**
     * Retrieve available error pages.
     */
    private function setAvailableErrorPages(

    ) :void {
        foreach (scandir(APP_VIEWS . "/pages/errors/") as $value) {
            if (in_array($value, array(".", "..")) || !strpos($value, ".html.")) continue;
            $this->availableErrorPages[str_replace(".twig", "", $value)] = $value;
        }
    }

    /**
     * Retrieve error messages.
     */
    private function setErrorMessages(

    ) :void {
        $this->errorMessages = Helpers::getYaml(APP_CONFIG . "/texts.yaml")["error"];
    }
}
