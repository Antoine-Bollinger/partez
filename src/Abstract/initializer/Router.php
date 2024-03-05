<?php
namespace Abollinger\Partez\Abstract\Initializer;

/**
 * Interface Router
 *
 * An interface defining the structure for Router initialization and rendering methods.
 * Classes implementing this interface should provide functionality for initialization
 * and rendering operations related to routing.
 */
interface Router 
{   
    /**
     * Initialization method to be implemented by classes using this interface.
     *
     * This method should handle initialization logic for the router.
     *
     * @return void
     */
    public function init();

    /**
     * Rendering method to be implemented by classes using this interface.
     *
     * This method should handle the rendering process for the router, such as
     * determining routes and producing the output.
     *
     * @return mixed The result of the rendering process
     */
    public function render();
}
