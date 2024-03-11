<?php 
namespace Partez\Controller;

use \Partez\Abstract;
use \Abollinger\Helpers;

final class ErrorController extends Abstract\Controller 
{
    private $errorMessages = [];
    private $availableErrorPages = [];

    public function init(

    ) {
        $this->getAvailableErrorPages();
        $this->getErrorMessages();
        $this->renderPage("errors/" . ($this->availableErrorPages[$this->params["code"]] ?? "error.html.twig"), [
            "code" => $this->params["code"],
            "message" => $this->errorMessages[$this->params["message"]] ?? $this->params["message"]
        ]);
    }

    private function getAvailableErrorPages(

    ) {
        foreach (scandir(APP_VIEW . "/pages/errors/") as $value) {
            if (in_array($value, array(".", "..")) || !strpos($value, ".html.")) continue;
            $this->availableErrorPages[str_replace(".html.twig", "", $value)] = $value;
        }
    }

    private function getErrorMessages(

    ) {
        $this->errorMessages = Helpers::getYaml(APP_CONFIG . "/texts.yaml")["error"];
    }
}
