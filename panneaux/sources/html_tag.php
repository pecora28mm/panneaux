<?php
/* Lozeil -- Copyright (C) No Parking 2013 - 2013 */

class Html_Tag {
	static function a($url, $string = "", $properties = array()) {
		if (!$string) {
			$string = $url;
		}
		
		$attributes = "";
		foreach ($properties as $attribute => $value) {
			$attributes .= " ".$attribute."=\"".$value."\"";
		}

		return "<a href=\"".$url."\"".$attributes.">".$string."</a>";
	}
}
