<?php 
namespace Partez\Api\Controllers;

use \Partez\Api\Abstract;

final class DefaultController extends Abstract\Controller
{
    /**
     * Retrieves a list of users from the UsersModel.
     * 
     * @return array The response containing user data and a status code.
     */
    public function getDefault(

    ) :array {
        $this->view->setCode(200);
        return $this->view->get();
    }
}