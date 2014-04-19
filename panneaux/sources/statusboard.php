<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

class Statusboard {
	public $etats_id = 0;
	public $actions_id = 0;
	public $pattern = "";

	function link($string) {
		return Html_Tag::a($this->url(), $string);
	}
	
	function url() {
		return "index.php?page=statusboard.php";
	}
	
	function filter() {
		$passage = new Passage();
		$etats_id = new Html_Select("etats_id", array('--' => "--") + $passage->etats(), $this->etats_id);
		$actions_id = new Html_Select("actions_id", array('--' => "--") + $passage->actions(), $this->actions_id);
		$pattern = new Html_Input("pattern", $this->pattern);
		
		$save = new Html_Input("save", __("filter"), "submit");

		return "<form method=\"post\" name=\"form-filter-statusboard\" id=\"form-filter-statusboard\" action=\"\">".
			$etats_id->item(__("status")).
			$actions_id->item(__("action")).
			$pattern->item(__("city")." / ".__("postcode")).
			$save->input().
		"</form>";
	}
	
	function display() {
		$passages = new Passages();
		if ($this->etats_id > 0) {
			$passages->etats_id = $this->etats_id;
		}
		if ($this->actions_id > 0) {
			$passages->actions_id = $this->actions_id;
		}
		if (!empty($this->pattern)) {
			$passages->pattern = $this->pattern;
		}
		$passages->last = true;
		$passages->select();
		return $passages->display();
	}
}
