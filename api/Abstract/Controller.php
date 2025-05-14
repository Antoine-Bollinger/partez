<?php
namespace Partez\Api\Abstract;

use \Abollinger\Helpers;
use \Abollinger\Response;

/**
 * Class Controller
 *
 * The abstract Controller class serves as a base for API controllers.
 * It provides functionality to handle HTTP request data (GET, POST, PUT) and manages the Response.
 */
abstract class Controller 
{
    /** @var array $get An array containing sanitized GET request parameters. */
    protected array $get;

    /** @var array $post An array containing sanitized POST request parameters. */
    protected array $post;

    /** @var array $put An array containing sanitized PUT request parameters. */
    protected array $put;

    /** @var array $files An array containing sanitized FILES request parameters. */
    protected array $files;

    /** @var Response $view Instance of Response to manage API responses. */
    protected Response $view;

    /**
     * Constructor for the Controller class.
     *
     * Initializes the object by sanitizing request parameters (GET, POST, PUT) and creating a Response instance.
     *
     * - Cleans and stores sanitized GET, POST, and PUT request parameters using Helpers::cleanArray().
     * - Reads PUT request data from the input stream and sanitizes it.
     * - Initializes a Response instance for managing API responses.
     */
    public function __construct(

    ) {
        $this->get = Helpers::cleanArray($_GET);
        $this->post = Helpers::cleanArray($_POST);
        parse_str(file_get_contents('php://input'), $put);
        $this->put = Helpers::cleanArray($put);
        $this->files = $_FILES ?? [];
        $this->view = new Response();
    }
}