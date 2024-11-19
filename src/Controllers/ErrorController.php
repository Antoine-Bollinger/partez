<?php 
/*
 * This file is part of the Partez package.
 *
 * (c) Antoine Bollinger <abollinger@partez.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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