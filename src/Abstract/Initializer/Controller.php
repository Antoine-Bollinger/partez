<?php 
/*
 * This file is part of the Partez package.
 *
 * (c) Antoine Bollinger <abollinger@partez.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Partez\Abstract\Initializer;

interface Controller 
{
    /**
     * Initialization method to be implemented by controllers.
     *
     * This method should handle any necessary initialization logic.
     *
     * @return void
     */
    public function init();    
}