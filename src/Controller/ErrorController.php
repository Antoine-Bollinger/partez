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
    /** @var array Error messages */
    private $errorMessages = [];
    
    /** @var array Available error pages */
    private $availableErrorPages = [];

    /**
     * Initialize error controller.
     */
    public function init(

    ) :void {
        $this->getAvailableErrorPages();
        $this->getErrorMessages();
        $this->renderPage("errors/" . ($this->availableErrorPages[$this->params["code"]] ?? "error.html.twig"), [
            "code" => $this->params["code"],
            "message" => $this->errorMessages[$this->params["message"]] ?? $this->params["message"]
        ]);
    }

    /**
     * Retrieve available error pages.
     */
    private function getAvailableErrorPages(

    ) :void {
        foreach (scandir(APP_VIEW . "/pages/errors/") as $value) {
            if (in_array($value, array(".", "..")) || !strpos($value, ".html.")) continue;
            $this->availableErrorPages[str_replace(".html.twig", "", $value)] = $value;
        }
    }

    /**
     * Retrieve error messages.
     */
    private function getErrorMessages(

    ) :void {
        $this->errorMessages = Helpers::getYaml(APP_CONFIG . "/texts.yaml")["error"];
    }
}
