<?php 
/*
 * This file is part of the Partez package.
 *
 * (c) Antoine Bollinger <abollinger@partez.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Partez\Abstract\Twig;

use \Abollinger\Helpers;
use \Twig\Extension\AbstractExtension;
use \Twig\TwigFilter;

/**
 * Class AppExtension
 * 
 * This Twig extension adds custom functionality to Twig templates.
 * Specifically, it provides a filter to format arrays as lists.
 * 
 * Methods:
 * - getFilters(): Registers the custom Twig filter(s) defined in this extension.
 * - formatList(array $arr = []): Formats an array into a list using a helper method.
 * 
 * Dependencies:
 * - \Abollinger\Helpers: A helper class used to process arrays (requires a `printArray` method).
 * - \Twig\Extension\AbstractExtension: Base class for creating Twig extensions.
 * - \Twig\TwigFilter: Class used to define and register new Twig filters.
 */

class AppExtension extends AbstractExtension
{
    /**
     * Registers custom Twig filters.
     * 
     * @return array List of TwigFilter instances.
     */
    public function getFilters(

    ) :array {
        return [
            new TwigFilter('list', [$this, 'formatList'])
        ];
    }

    /**
     * Formats an array into a list.
     * 
     * @param array $arr The array to format (defaults to an empty array).
     * @return string The formatted list representation of the array.
     */
    public function formatList(
        array $arr = []
    ) :string {
        return Helpers::printArray($arr);
    }
}