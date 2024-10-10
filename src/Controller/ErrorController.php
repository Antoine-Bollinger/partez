<?php
namespace Partez\Controller;

use \Partez\Abstract;
use \Abollinger\Helpers;

/**
 * Class ErrorController
 * 
 * Controller for handling errors.
 * 
 * @package Partez\Controller
 */
final class ErrorController extends Abstract\Controller 
{
    /**
     * Initialize error controller.
     */
    public function init(

    ) :void {
        $this->renderPage("errors/" . ($this->availableErrorPages[$this->params["code"]] ?? "error.html.twig"), [
            "code" => $this->params["code"],
            "message" => $this->errorMessages[$this->params["message"]] ?? $this->params["message"]
        ]);
    }
}