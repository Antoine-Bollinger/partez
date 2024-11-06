<?php
namespace Partez\Controllers;

use \Partez\Abstract;
use \Abollinger\Helpers;

/**
 * Class ErrorController
 * 
 * Controller for handling errors.
 * 
 * @package Partez\Controllers
 */
final class ErrorController extends Abstract\Controller 
{
    /**
     * Initialize error controller.
     */
    public function init(

    ) :void {
        $this->renderPage("errors/" . ($this->availableErrorPages[$this->params["code"]] ?? "Error.twig"), [
            "code" => $this->params["code"],
            "message" => $this->errorMessages[$this->params["message"]] ?? $this->params["message"]
        ]);
    }
}