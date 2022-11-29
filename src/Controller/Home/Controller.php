<?php 
namespace Abollinger\StarterPhp\Controller;

class HomeController extends Controller
{
    public function __construct(
		$params = null
	) {
		parent::__construct($params);
        $this->renderView("home.twig");
    }
}