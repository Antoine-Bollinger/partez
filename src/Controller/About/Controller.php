<?php 
namespace Abollinger\StarterPhp\Controller;

class AboutController extends Controller
{
    public function __construct(
		$params = null
	) {
		parent::__construct($params);

		$text = file_get_contents(APP_ROOT . "/README.md");

        $this->renderView("about.twig", [
            "readme" => $this->renderMarkdown($text)
        ]);
    }
}