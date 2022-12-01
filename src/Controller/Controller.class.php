<?php 
namespace Abollinger\PHPStarter\Controller;

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
use \Twig\Extra\Html\HtmlExtension;
use \Twig\Extra\Intl\IntlExtension;
use \Twig\Extension\DebugExtension;

class FrontendController 
{
    private $twig;
    public $params;

    public function __construct(
        $params = null
    ) {
        $this->params = $params;
        $this->setTwig();
    }

    private function setTwig(
        $cache = false
    ) {
        $loader = new FilesystemLoader(APP_MODEL_PATH);
        $this->twig = new Environment($loader, [
            "cache" => $cache,
            "debug" => true
        ]);
        $this->twig->addExtension(new HtmlExtension());
        $this->twig->addExtension(new DebugExtension());
        $this->twig->addExtension(new IntlExtension());
        $this->twig->addGlobal("app_title", APP_TITLE);
        $this->twig->addGlobal("app_subdir", APP_SUBDIR);
        $this->twig->addGlobal("_params", $this->params);
    }

    public function renderView(
        $file = "",
        $params = []
    ) {
        try {
            if (!file_exists(APP_MODEL_PATH . "/views/" . $file)) {
                throw new \Exception("model", 500);
            }
			echo $this->twig->render("views/" . $file, $params);
        } catch(Exception $e) {
			throw new \Exception($e);
		}
    }

    public function renderMarkdown(
		$text = ""
	) {
		$Parsedown = new \Parsedown();
		return $Parsedown->text($text);
	}
}
