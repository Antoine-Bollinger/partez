<?php 
namespace Partez\Controllers;

use \Partez\Abstract;

final class HomeController extends Abstract\Controller 
{
    /**
     * @Route("/", name="Home")
     */
    public function init(

    ) {
        $this->renderPage("HomeView.twig");
    }
}
