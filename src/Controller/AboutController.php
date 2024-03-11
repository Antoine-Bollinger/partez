<?php 
namespace Partez\Controller;

use \Partez\Abstract;

final class AboutController extends Abstract\Controller 
{
    /**
     * @Route("/about", name="About")
     */
    public function init(

    ) {
        $this->renderPage("about.html.twig", [
            "readme" => $this->renderMd(APP_ROOT . "/README.md")
        ]);
    }
}
