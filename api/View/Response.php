<?php
namespace Partez\Api\View;

use \Abollinger\Helpers;

/**
 * Class Response
 *
 * The Response class manages API response creation and handling.
 * It provides methods to set response parameters, retrieve response data, and send JSON responses.
 */
final class Response 
{
    /** @var array $response An array storing the API response parameters. */
    public array $response;

    /** @var array $default The default API response parameters. */
    private array $default;

    /**
     * Constructor for the Response class.
     *
     * Initializes the default response parameters and sets the initial response.
     */
    public function __construct(

    ) {
        $this->default = [
            "code" => 200,
            "success" => true,
            "message" => "Welcome to Partez API! 🚀",
            "state" => 0,
            "data" => []
        ];
        $this->response = $this->default;
    }

    /**
     * Sends the API response as JSON and exits the script.
     *
     * @return void
     */
    public function sendJSON(

    ) :void {
        http_response_code($_SERVER['REQUEST_METHOD'] === 'OPTIONS' ? 200 : $this->getCode());
        header("Access-Control-Allow-Origin: " . ALLOW_ORIGIN);
        header("Access-Control-Allow-Methods: " . ALLOW_METHODS);
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Access-Control-Allow-Credentials: true");
        header("Content-type: application/json; charset=UTF-8");
        echo json_encode($this->response);
        exit;
    }

    /**
     * Sets the API response parameters using the provided array.
     *
     * @param array $arr An array of response parameters (default: [])
     * @return array The updated API response parameters
     */
    public function set(
        $arr = []
    ) :array {
        $this->response = Helpers::defaultParams($this->response, $arr);
        return $this->response;
    }

    /**
     * Sets the HTTP status code in the API response.
     *
     * @param int $code The HTTP status code (default: 200)
     * @return array The updated API response parameters
     */
    public function setCode(
        $code = 200
    ) :array {
        $this->response["code"] = $code;
        return $this->response;
    }

    /**
     * Sets the 'success' status in the API response.
     *
     * @param bool $success The 'success' status (default: true)
     * @return array The updated API response parameters
     */
    public function setSuccess(
        $success = true
    ) :array {
        $this->response["success"] = $success;
        return $this->response;
    }

    /**
     * Sets the 'message' in the API response.
     *
     * @param string $message The 'message' (default: 'Welcome to Partez API! 🚀')
     * @return array The updated API response parameters
     */
    public function setMessage(
        $message = "Welcome to Partez API! 🚀"
    ) :array {
        $this->response["message"] = $message;
        return $this->response;
    }

    /**
     * Sets the 'state' in the API response.
     *
     * @param string $message The 'state' (default: 0)
     * @return array The updated API response parameters
     */
    public function setState(
        $state = 0
    ) :array {
        $this->response["state"] = $state;
        return $this->response;
    }

    /**
     * Sets the 'data' in the API response.
     *
     * @param string $data The 'data' given by the sql request (default: empty array [])
     * @return array The updated API response parameters
     */
    public function setData(
        $data = []
    ) :array {
        $this->response["data"] = $data;
        return $this->response;
    }

    /**
     * Retrieves the API response parameters.
     *
     * @return array The current API response parameters
     */
    public function get(

    ) :array {
        return $this->response;
    }

    /**
     * Retrieves the API response parameters.
     *
     * @return int The current API response 'code' parameter
     */
    public function getCode(

    ) :int {
        return $this->response["code"];
    }

    /**
     * Retrieves the API response parameters.
     *
     * @return bool The current API response 'success' parameter
     */
    public function getSuccess(

    ) :bool {
        return $this->response["success"];
    }

    /**
     * Retrieves the API response parameters.
     *
     * @return string The current API response 'message' parameter
     */
    public function getMessage(

    ) :string {
        return $this->response["message"];
    }

    /**
     * Retrieves the API response parameters.
     *
     * @return int The current API response 'state' parameter
     */
    public function getState(

    ) :int {
        return $this->response["state"];
    }

    /**
     * Retrieves the API response parameters.
     *
     * @return array The current API response 'data' parameter
     */
    public function getData(

    ) :array {
        return $this->response["data"];
    }
}