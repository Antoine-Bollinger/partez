<?php 
namespace Abollinger\PHPStarter\Controller;

class Controller extends FrontendController
{
    public function __construct(
		$params = null
	) {
		parent::__construct($params);

		$text = file_get_contents(APP_ROOT . "/README.md");
		$text = str_replace("public/images", APP_SUBDIR."/public/images", $text);

        $this->renderView("about.twig", [
            "readme" => $this->renderMarkdown($text)
        ]);
    }
}