<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

class Passages extends Collector {
	function __construct(Db $db = null) {
		parent::__construct("Passage", "passages", $db);
	}
	
	function names() {
		$names = array();
		foreach ($this as $passage) {
			$names[$passage->id] = $passage->name;
		}
		return $names;
	}

	function display() {
		if (count($this) > 0) {
			$html = "<ul>";
			foreach ($this as $passage) {
				$html .= "<li>".$passage->link()."</li>";
			}
			$html .= "</ul>";
		}
		return $html;
	}
}
