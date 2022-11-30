<?php
namespace Abollinger\PHPStarter\Config;

/**
 * 
 */
class Helpers 
{
	/**
	 * Render PHP array into a HTML ul list
	 * 
	 * @param array $arr
	 * @return string
	 */
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

	public static function scanDirectories(
		$rootDir, 
		$allData = array()
	) : array {
		$invisibleFileNames = array(".", "..", "Controller.class.php");
		$dirContent = scandir($rootDir);
		foreach ($dirContent as $key => $content) {
			$path = $rootDir.'/'.$content;
			if (!in_array($content, $invisibleFileNames)) {
				if(is_file($path) && is_readable($path)) {
					$tmp = str_replace(APP_CONTROLLER_PATH, "", $path);
					$route = explode("/", $tmp);
					$allData[] = [
						"exeFile" => array_pop($route),
						"route" => strtolower(implode("/", $route)),
						"name" => implode("", $route),
						"controller" => $tmp,
					];
				}elseif(is_dir($path) && is_readable($path)) {
					$allData = self::scanDirectories($path, $allData);
				}
			}
		}
		return $allData;
	}
}