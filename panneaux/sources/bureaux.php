<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

class Bureaux extends Collector {
	function __construct(Db $db = null) {
		parent::__construct("Bureau", "bureaux", $db);
	}
	
	function objects_indexed_on_id() {
		$objects = array();
		foreach ($this as $bureau) {
			$objects[$bureau->id] = $bureau;
		}
		return $objects;
	}
	
	function names() {
		$names = array();
		foreach ($this as $bureau) {
			$names[$bureau->id] = $bureau->name;
		}
		return $names;
	}

	function link_with_pattern($string, $pattern) {
		return Html_Tag::a($this->url_with_pattern($pattern), $string);
	}

	function url_with_pattern($pattern) {
		return "index.php?page=bureaux.php&pattern=".$pattern;
	}

	function display() {
		$html = "";
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
				$html .= "<td>".$this->link_with_pattern($bureau->postcode, $bureau->postcode)."</td>";
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
		
		if (isset($this->id)) {
			if (is_array($this->id)) {
				$where[] = "bureaux.id IN (".join(",", $this->id).")";
			} else {
				$where[] = "bureaux.id = ".(int)$this->id;
			}
		}
		if (isset($this->pattern)) {
			$where[] = "(
				bureaux.name LIKE ".$this->db->quote("%".$this->pattern."%")." OR
				bureaux.address LIKE ".$this->db->quote("%".$this->pattern."%")." OR
				bureaux.postcode LIKE ".$this->db->quote("%".$this->pattern."%")." OR
				bureaux.city LIKE ".$this->db->quote("%".$this->pattern."%")."
			)";
		}

		return $where;
	}
}
