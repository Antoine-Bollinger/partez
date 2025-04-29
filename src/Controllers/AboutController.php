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

final class AboutController extends Abstract\Controller 
{
    /**
     * @Route("/about", name="About")
     */
    public function init(

    ) :void {
        $this->renderPage("AboutView.twig", [
            "readme" => $this->renderMd(APP_ROOT . "/README.md")
        ]);
    }
}
