<?php
namespace Abollinger\StarterPhp\Config;

class Helpers 
{
    public static function printArray(
		$arr
	) : string {
		if (!is_array($arr)) return false;
		static $closingTag = array();
		$str = "<ul>\r\n";
		$closingTag[] = "</ul>\r\n";
		foreach ($arr as $k => $v) {
			if(is_array($v)){
				$str .= "<li>$k => <em>array</em>\r\n";
				$str .= self::printArray($v);
			} else {
				$display = is_bool($v) ? ($v ? 'true' : 'false') : htmlentities(is_string($v) || is_float($v) || is_int($v) ? $v : '');
				$str .= "<li>$k => <span style=\"font-weight:bold;\">".$display."</span>";
			}
			$closingTag[] = "</li>\r\n";
			$str .= array_pop($closingTag);
		}
		$str .= array_pop($closingTag);
		return $str;
	}
}