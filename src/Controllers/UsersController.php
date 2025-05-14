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
use \Partez\Models\ApiModel;

final class UsersController extends Abstract\Controller 
{
    /**
     * @Route(path="/users", name="Users")
     */
    public function users(

    ) :void {
        $data = ApiModel::get("/users");

        $this->renderPage("UsersView.twig", [
            "users" => $data
        ]);
    }
}
