<?php
namespace Partez\Abstract\Twig;

use \Abollinger\Helpers;
use \Twig\Extension\AbstractExtension;
use \Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters() 
    {
        return [
            new TwigFilter('list', [$this, 'formatList'])
        ];
    }

    public function formatList(
        array $arr = []
    ) {
        return Helpers::printArray($arr);
    }
}