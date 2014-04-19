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
			$passage = new Passage();
			$etats_names = $passage->etats();
			$actions_names = $passage->actions();

			$html = "<table>";
			$html .= "<tr>";
			$html .= "<th>".__("postcode")."</th>";
			$html .= "<th>".__("name")."</th>";
			$html .= "<th>".__("status")."</th>";
			$html .= "<th>".__("action")."</th>";
			$html .= "</tr>";

			foreach ($this as $passage) {
				if (!isset($bureaux[$passage->bureaux_id])) {
					$bureaux[$passage->bureaux_id] = new Bureau();
					$bureaux[$passage->bureaux_id]->load($passage->bureaux_id);
				}
				$html .= "<tr>";
				$html .= "<td>".$bureaux[$passage->bureaux_id]->postcode."</td>";
				$html .= "<td>".$bureaux[$passage->bureaux_id]->link()."</td>";
				$html .= "<td>".$passage->link($etats_names[$passage->etats_id])."</td>";
				$html .= "<td>".$passage->link($actions_names[$passage->actions_id])."</td>";
				$html .= "</tr>";
			}
			$html .= "</table>";
		}

		return $html;
	}
	
	function get_where() {
		$where = parent::get_where();
		
		if (isset($this->bureaux_id)) {
			$where[] = "passages.bureaux_id = ".(int)$this->bureaux_id;
		}
		
		return $where;
	}
}
