<?php 
namespace Partez\Controllers;

use \Partez\Abstract;
use \Partez\Models\ApiModel;

final class UsersController extends Abstract\Controller 
{
    /**
     * @Route("/users", name="Users")
     */
    public function init(

    ) {
        $data = ApiModel::get("/users");

        $this->renderPage("UsersView.twig", [
            "users" => $data
        ]);
    }
}
