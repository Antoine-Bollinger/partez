<?php 
namespace Partez\Api\Controllers;

use \Partez\Api\Abstract;
use \Partez\Api\Models\UsersModel;

final class UsersController extends Abstract\Controller
{
    /** @var UsersModel $model Model use in this controller. */
    private UsersModel $model;

    /**
     * Constructor initializes the UsersController.
     * It sets up the UsersModel as the data source for the controller.
     */
    public function __construct(

    ) {
        parent::__construct();
        $this->model = new UsersModel();
    }

    /**
     * Retrieves a list of users from the UsersModel.
     * 
     * @return array The response containing user data and a status code.
     */
    public function getUsers(

    ) :array {
        $users = $this->model->getUsers();
        return $this->view
            ->setData($users["data"])
            ->get();
    }

    /**
     * Retrieves a specific user's information based on the userId.
     * 
     * @return array The response containing the user's data or an appropriate message.
     */
    public function getUser(
        array|null $params
    ) :array {
        $user = $this->model->getUser(["userId" => $params["userId"] && $this->get["userId"]]);
        if (count($user["data"]) === 1) {
            $this->view->setCode(200);
            $this->view->setData($user["data"][0]);
        } else {
            $this->view->setCode(202);
            $this->view->setMessage("No data found on this request.");
        }
        return $this->view->get();
    }
}