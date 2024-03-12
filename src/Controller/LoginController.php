<?php 
namespace Partez\Controller;

use \Partez\Abstract;

final class LoginController extends Abstract\Controller 
{
    /**
     * @Route("/login", name="Login")
     */
    public function init(

    ) {
        $this->renderPage("login.html.twig");
    }
}

