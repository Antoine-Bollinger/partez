<?php
namespace Partez\Api;

use \Abollinger\Session;

final class Starter
{
        
    /** @var Session $session Session object for handling user sessions. */
    private $session;
    
    public function __construct(

    ) {
        $this->session = new Session();
        echo $this->session->isLoggedAndAuthorized() ? "oui" : "non";
        echo "Api";
    }
}