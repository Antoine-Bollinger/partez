<?php 
namespace Abollinger\Partez\Controller;

use \Abollinger\Partez\Abstract;

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
