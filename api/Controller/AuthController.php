<?php 
namespace Partez\Api\Controller;

use \Partez\Api\Abstract;
use \Partez\Api\Model\AuthModel;
use \Abollinger\Session;

final class AuthController extends Abstract\Controller 
{
    private $model;
    private $session;

    /** 
     * The Auth controller handle the logic to login and logout in the API. When successfully logged in, the client receive an Bearer token that must be present in all requests header to get a response.
     */
    public function __construct(

    ) {
        parent::__construct();
        $this->model = new AuthModel();
        $this->session = new Session();
    }

    /**
     * Method for handling user login.
     *
     * @param string userId     The userId of the user. Must be obtained from $_POST.
     * @param string password   The password of the user. Must be obtained from $_POST.
     * @return array    Returns an array based on the ResponseView class representing a standardized API response.
     */
    public function login(

    ) :array {
        if (isset($this->post["userId"]) && isset($this->post["password"])) {        
            $user = $this->model->getUser(["userId" => $this->post["userId"]]);
            if (count($user["data"]) === 1) {
                $testPassword = password_verify($this->post["password"], $user["data"][0]["password"]);
                if ($testPassword) {
                    $token = "Bearer " . bin2hex(random_bytes(20));
                    $this->session->login([
                        "userId" => $user["data"][0]["userId"],
                        "token" => $token
                    ]);
                    $this->view->setCode(200);
                    $this->view->setMessage($token);
                } else {                
                    $this->view->setCode(401);
                    $this->view->setSuccess(false);
                    $this->view->setMessage("Password seems to be wrong.");
                }
            } else {
                $this->view->setCode(401);
                $this->view->setSuccess(false);
                $this->view->setMessage("There is no user with this login.");
            }
        } else {
            $this->view->setCode(200);
            $this->view->setSuccess(false);
            $this->view->setMessage("🚀 Welcome to Partez API! Please provide a valid userId & password to log in.");
        }
        return $this->view->get();
    }

    /**
     * Method for handling user logout.
     *
     * @return array    Returns an array based on the ResponseView class representing a standardized API response.
     */
    public function logout(

    ) :array {
        $this->session->logout();
        $this->view->setMessage("You have successfully logged out from the application.");
        return $this->view->get();
    }
}