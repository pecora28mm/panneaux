<?php
/* Nouvelle Donne -- Copyright (C) No Parking 2014 - 2014 */

class Bureau extends Record {
	public $id = 0;
	public $name = "";
	public $address = "";
	public $postcode = "";
	public $city = "";
	
	function __construct($id = 0, db $db = null) {
		parent::__construct($db);
		$this->id = $id;
	}

	function db($db) {
		if ($db instanceof db) {
			$this->db = $db;
		}
	}
	
	function link() {
		return Html_Tag::a($this->url(), $this->name);
	}
	
	function url() {
		return "index.php?page=bureau.php&id=".$this->id;
	}
	
	function clean($post) {
		$cleaned = array();
		
		if (isset($post['id'])) {
			$cleaned['id'] = (int)$post['id'];
		}
		if (isset($post['name'])) {
			$cleaned['name'] = trim($post['name']);
		}
		if (isset($post['address'])) {
			$cleaned['address'] = trim($post['address']);
		}
		if (isset($post['postcode'])) {
			$cleaned['postcode'] = trim($post['postcode']);
		}
		if (isset($post['city'])) {
			$cleaned['city'] = trim($post['city']);
		}
		
		return $cleaned;
	}
	
	function edit() {
		$id = new Html_Input("bureau[id]", $this->id);
		$name = new Html_Input("bureau[name]", $this->name);
		$address = new Html_Textarea("bureau[address]", $this->address);
		$postcode = new Html_Input("bureau[postcode]", $this->postcode);
		$city = new Html_Input("bureau[city]", $this->city);
		
		$save = new Html_Input(__("save"), "save", "submit");

		return "<form method=\"post\" name=\"form-edit-bureau\" id=\"form-edit-bureau\" action=\"\" enctype=\"multipart/form-data\">".
			$id->input_hidden().
			$name->item(__("name")).
			$address->item(__("address")).
			$postcode->item(__("postcode")).
			$city->item(__("city")).
			$save->input().
		"</form>";
	}

	function load(array $key = array(), $table = "bureaux", $columns = null) {
		if (empty($key) or $key['id'] == 0) {
			if ($this->id === 0) {
				return false;
			} else {
				$key = array ("id" => $this->id);
			}
		}
		return parent::load($key, $table, $columns);
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
			INSERT INTO bureaux
			SET name = ".$this->db->quote($this->name).",
			address = ".$this->db->quote($this->address).",
			postcode = ".$this->db->quote($this->postcode).",
			city = ".$this->db->quote($this->city)
		);
		$this->id = $result[2];
		$this->db->status($result[1], "i", __("bureau"));

		return $this->id;
	}
	
	function update() {
		$result = $this->db->query("
			UPDATE bureaux
			SET name = ".$this->db->quote($this->name).",
			address = ".$this->db->quote($this->address).",
			postcode = ".$this->db->quote($this->postcode).",
			city = ".$this->db->quote($this->city)."
			WHERE id = ".(int)$this->id
		);
		$this->db->status($result[1], "u", __("bureau"));

		return $this->id;
	}

	function delete() {
		$result = $this->db->query("
			DELETE FROM bureaux
			WHERE id = ".(int)$this->id
		);
		$this->db->status($result[1], "d", __("bureau"));

		return $this->id;
	}
	
	function is_deletable() {
		return true;
	}
}
