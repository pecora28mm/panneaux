<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

class Passages extends Collector {
	function __construct(Db $db = null) {
		parent::__construct("Passage", "passages", $db);
	}
	
	function bureaux_id() {
		$bureaux_id = array();
		foreach ($this as $passage) {
			$bureaux_id[] = $passage->bureaux_id;
		}
		return array_unique($bureaux_id);
	}

	function names() {
		$names = array();
		foreach ($this as $passage) {
			$names[$passage->id] = $passage->name;
		}
		return $names;
	}

	function display() {
		$html = "";

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
			$html .= "<th>".__("day")."</th>";
			$html .= "</tr>";
			
			$bureaux = new Bureaux();
			$bureaux->id = $this->bureaux_id();
			$bureaux->select();
			$bureaux_per_id = $bureaux->objects_indexed_on_id();

			foreach ($this as $passage) {
				$html .= "<tr>";
				$html .= "<td>".$bureaux_per_id[$passage->bureaux_id]->postcode."</td>";
				$html .= "<td>".$passage->link($bureaux_per_id[$passage->bureaux_id]->name)."</td>";
				$html .= "<td>".$passage->link(isset($etats_names[$passage->etats_id]) ? $etats_names[$passage->etats_id] : __("--"))."</td>";
				$html .= "<td>".$passage->link(isset($actions_names[$passage->actions_id]) ? $actions_names[$passage->actions_id] : __("--"))."</td>";
				$html .= "<td>".date("d/m/Y", $passage->time)."</td>";
				$html .= "</tr>";
			}
			$html .= "</table>";
		}

		return $html;
	}
	
	function show_history() {
		$html = "";
		
		if (count($this) > 0) {
			$passage = new Passage();
			$etats_names = $passage->etats();
			$actions_names = $passage->actions();
		
			$html .= "<h3>".__("Archives")."</h3>";
			foreach ($this as $passage) {
				$html .= "<div class=\"passage-history\">";
				$html .= "<p><strong>".__("day")."</strong> ".date("d/m/Y H:i", $passage->time)."<br />";
				$html .= "<strong>".__("status")."</strong> ".(isset($etats_names[$passage->etats_id]) ? $etats_names[$passage->etats_id] : __("--"))."<br />";
				$html .= "<strong>".__("action")."</strong> ".(isset($actions_names[$passage->actions_id]) ? $actions_names[$passage->actions_id] : __("--"))."<br />";
				$html .= "<strong>".__("comment")."</strong> ".$passage->comment."</p>";
				$html .= "</div>";
			}
		}
		
		return $html;
	}
	
	function get_join() {
		$join = parent::get_join();
		
		if (isset($this->pattern)) {
			$join[] = "INNER JOIN bureaux ON bureaux.id = passages.bureaux_id";
		}

		return $join;
	}
	
	function get_where() {
		$where = parent::get_where();
		
		if (isset($this->actions_id)) {
			$where[] = "passages.actions_id = ".(int)$this->actions_id;
		}
		if (isset($this->bureaux_id)) {
			$where[] = "passages.bureaux_id = ".(int)$this->bureaux_id;
		}
		if (isset($this->etats_id)) {
			$where[] = "passages.etats_id = ".(int)$this->etats_id;
		}
		if (isset($this->last)) {
			$where[] = "passages.id IN (SELECT MAX(id) FROM passages GROUP BY bureaux_id)";
		}
		if (isset($this->pattern)) {
			$where[] = "(
				bureaux.name LIKE ".$this->db->quote("%".$this->pattern."%")."
				OR bureaux.address LIKE ".$this->db->quote("%".$this->pattern."%")."
				OR bureaux.postcode LIKE ".$this->db->quote("%".$this->pattern."%")."
				OR bureaux.city LIKE ".$this->db->quote("%".$this->pattern."%").
			")";
		}
		
		return $where;
	}
}
