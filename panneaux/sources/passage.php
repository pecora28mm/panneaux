<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

class Passage extends Record {
	public $id = 0;
	public $bureaux_id = 0;
	public $comment = "";
	public $etats_id = 0;
	public $actions_id = 0;
	public $time = 0;
		
	function __construct($id = 0, db $db = null) {
		parent::__construct($db);
		$this->id = $id;
	}

	function db($db) {
		if ($db instanceof db) {
			$this->db = $db;
		}
	}
	
	function link($string) {
		if (empty($string)) {
			$string = $this->comment;
		}
		return Html_Tag::a($this->url(), $string);
	}
	
	function url() {
		return "index.php?page=passage.php&id=".$this->id;
	}
	
	function clean($post) {
		$cleaned = array();
		
		if (isset($post['id'])) {
			$cleaned['id'] = (int)$post['id'];
		}
		if (isset($post['bureaux_id'])) {
			$cleaned['bureaux_id'] = (int)$post['bureaux_id'];
		}
		if (isset($post['comment'])) {
			$cleaned['comment'] = trim($post['comment']);
		}
		if (isset($post['etats_id'])) {
			$cleaned['etats_id'] = (int)$post['etats_id'];
		}
		if (isset($post['actions_id'])) {
			$cleaned['actions_id'] = (int)$post['actions_id'];
		}
		
		return $cleaned;
	}
	
	function etats() {
		return array(
			'1' => __("empty"),
			'2' => __("riped off"),
			'3' => __("written over"),
			'4' => __("covered up"),
			'5' => __("clean"),
			'6' => __("cleanish"),
		);
	}

	function actions() {
		return array(
			'1' => __("nothing to do"),
			'2' => __("needs new billboard"),
			'3' => __("taken care of"),
			'4' => __("needs surveillance"),
		);
	}

	function edit() {
		$id = new Html_Input("passage[id]", $this->id);
		$selected = array();
		$bureau = new Bureau();
		if ($this->bureaux_id > 0) {
			$bureau->load($this->bureaux_id);
			$selected = array($bureau->id => $bureau->name);
		}
		$bureaux_id = new Html_Input_Ajax("passage[bureaux_id]", "index.php?page=bureaux.ajax.php", $selected);
		$bureaux_id->properties['placeholder'] = __("postcode, city or address");
		$comment = new Html_Textarea("passage[comment]", $this->comment);
		$etats_id = new Html_Select("passage[etats_id]", array('--' => "--") + $this->etats(), $this->etats_id);
		$actions_id = new Html_Select("passage[actions_id]", array('--' => "--") + $this->actions(), $this->actions_id);
		
		$save = new Html_Input("save", __("save"), "submit");
		$save->class = "btn btn-lg btn-success";

		return "<form method=\"post\" name=\"form-edit-passage\" id=\"form-edit-passage\" action=\"\" enctype=\"multipart/form-data\">".
			$id->input_hidden().
			$bureaux_id->item(__("bureau")).
			$comment->item(__("comment")).
			$etats_id->item(__("status")).
			$actions_id->item(__("action")).
			$save->input().
			"<p class=\"details\">".__("last update : %s", array(($this->time > 0) ? date("d/m/Y H:i", $this->time) : ""))."</p>".
		"</form>";
	}

	function load($id = null, $table = "passages", $columns = null) {
		return parent::load($id, $table, $columns);
	}
		
	function save() {
		if (is_numeric($this->id) and $this->id != 0) {
			$this->id = $this->update();
		} else {
			$this->id = $this->insert();
		}
		return $this->id;
	}
	
	function insert() {
		$result = $this->db->id("
			INSERT INTO passages
			SET bureaux_id = ".(int)$this->bureaux_id.",
			comment = ".$this->db->quote($this->comment).",
			etats_id = ".(int)$this->etats_id.",
			actions_id = ".(int)$this->actions_id.",
			time = ".time()
		);
		$this->id = $result[2];
		$this->db->status($result[1], "i", __("passage"));

		return $this->id;
	}
	
	function update() {
		$result = $this->db->query("
			UPDATE passages
			SET bureaux_id = ".(int)$this->bureaux_id.",
			comment = ".$this->db->quote($this->comment).",
			etats_id = ".(int)$this->etats_id.",
			actions_id = ".(int)$this->actions_id.",
			time = ".time()."
			WHERE id = ".(int)$this->id
		);
		$this->db->status($result[1], "u", __("passage"));

		return $this->id;
	}

	function delete() {
		$result = $this->db->query("
			DELETE FROM passages
			WHERE id = ".(int)$this->id
		);
		$this->db->status($result[1], "d", __("passage"));

		return $this->id;
	}
	
	function is_deletable() {
		return true;
	}
}
