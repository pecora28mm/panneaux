<?php
/* Nouvelle Donne -- Copyright (C) No Parking 2014 - 2014 */

class Bureaux extends Collector {
	function __construct(Db $db = null) {
		parent::__construct("Bureau", "bureaux", $db);
	}
	
	function display() {
		if (count($this) > 0) {
			$html = "<ul>";
			foreach ($this as $bureau) {
				$html .= "<li>".$bureau->link()."</li>";
			}
			$html .= "</ul>";
		}
		return $html;
	}
}
