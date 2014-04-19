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
			$html = "<table>";
			$html .= "<tr>";
			$html .= "<th>".__("postcode")."</th>";
			$html .= "<th>".__("name")."</th>";
			$html .= "<th>".__("address")."</th>";
			$html .= "<th>".__("city")."</th>";
			$html .= "</tr>";
			
			foreach ($this as $bureau) {
				$html .= "<tr>";
				$html .= "<td>".$bureau->postcode."</td>";
				$html .= "<td>".$bureau->link()."</td>";
				$html .= "<td>".$bureau->address."</td>";
				$html .= "<td>".$bureau->city."</td>";
				$html .= "</tr>";
			}
			$html .= "</table>";
		}
		return $html;
	}
	
	function get_where() {
		$where = parent::get_where();
		
		if (isset($this->search)) {
			$where[] = "(
				bureaux.name LIKE ".$this->db->quote("%".$this->search."%")." OR
				bureaux.address LIKE ".$this->db->quote("%".$this->search."%")." OR
				bureaux.postcode LIKE ".$this->db->quote("%".$this->search."%")." OR
				bureaux.city LIKE ".$this->db->quote("%".$this->search."%")."
			)";
		}

		return $where;
	}
}
