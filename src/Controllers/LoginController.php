<?php 
namespace Partez\Controllers;

use \Partez\Abstract;

final class LoginController extends Abstract\Controller 
{
    /**
     * @Route("/login", name="Login")
     */
    public function init(

    ) {
        $this->renderPage("LoginView.twig");
    }
}

