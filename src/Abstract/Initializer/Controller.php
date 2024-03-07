<?php 
namespace Abollinger\Partez\Abstract\Initializer;

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