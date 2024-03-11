<?php 
namespace Partez\Controller;

use \Partez\Abstract;

final class HomeController extends Abstract\Controller 
{
    /**
     * @Route("/", name="Home")
     */
    public function init(

    ) {
        $this->renderPage("home.html.twig");
    }
}
