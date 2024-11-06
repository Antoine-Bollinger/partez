<?php 
namespace Partez\Controllers;

use \Partez\Abstract;

final class AboutController extends Abstract\Controller 
{
    /**
     * @Route("/about", name="About")
     */
    public function init(

    ) {
        $this->renderPage("AboutView.twig", [
            "readme" => $this->renderMd(APP_ROOT . "/README.md")
        ]);
    }
}
