<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

class Bureaux extends Collector {
	function __construct(Db $db = null) {
		parent::__construct("Bureau", "bureaux", $db);
	}
	
	function names() {
		$names = array();
		foreach ($this as $bureau) {
			$names[$bureau->id] = $bureau->name;
		}
		return $names;
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
