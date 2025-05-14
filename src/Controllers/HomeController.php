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

final class HomeController extends Abstract\Controller 
{
    /**
     * @Route(path="/", name="Home")
     */
    public function home(

    ) :void {
        $this->renderPage("HomeView.twig");
    }
}
