<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

require_once __DIR__."/../sources/bootloader.php";

class tests_Bureau extends TableTestCase {
	function __construct() {
		parent::__construct();
		$this->initializeTables(
			"bureaux"
		);
	}
	
	function test_clean() {
		$post = array (
			'id' => "0",
			'name' => " Espace devant",
			'address' => "Espace derrière \n",
			'postcode' => "59000",
			'city' => " Lille ",
			'autre truc' => "bizarre",
		);
		$cleaned = array (
			'id' => "0",
			'name' => "Espace devant",
			'address' => "Espace derrière",
			'postcode' => "59000",
			'city' => "Lille",
		);
		$bureau = new Bureau();
		$this->assertEqual($bureau->clean($post), $cleaned);
	}
	
	function test_edit() {
		$bureau = new Bureau();
		$this->assertPattern("/bureau\[id\]/", $bureau->edit());
		$this->assertPattern("/bureau\[name\]/", $bureau->edit());
		$this->assertPattern("/bureau\[address\]/", $bureau->edit());
		$this->assertPattern("/bureau\[postcode\]/", $bureau->edit());
		$this->assertPattern("/bureau\[city\]/", $bureau->edit());
	}

	function test_save_load() {
		$bureau = new Bureau();
		$bureau->name = "Bureau de vote n°1 Allennes les Marais";
		$bureau->address = "Salle Polyvalente\nRue de Verdun";
		$bureau->postcode = "59251";
		$bureau->city = "Allennes-les-Marais";
		$this->assertTrue($bureau->save());

		$bureau_loaded = new Bureau();
		$bureau_loaded->id = 1;
		$bureau_loaded->load();
		
		$this->assertEqual($bureau_loaded->name, $bureau->name);
		$this->assertEqual($bureau_loaded->address, $bureau->address);
		$this->assertEqual($bureau_loaded->postcode, $bureau->postcode);
		$this->assertEqual($bureau_loaded->city, $bureau->city);
		
		$this->truncateTable("bureaux");
	}
	
	function test_update() {
		$bureau = new Bureau();
		$bureau->name = "Bureau de vote n°1 Allennes les Marais";
		$bureau->save();
		
		$bureau_loaded = new Bureau();
		$bureau_loaded->id = 1;
		$bureau_loaded->name = "Bureau de vote n°1 Allennes les Marais avec changement";
		$this->assertTrue($bureau_loaded->update());
		
		$bureau_loaded2 = new Bureau();
		$bureau_loaded2->id = 1;
		$bureau_loaded2->load();
		$this->assertNotEqual($bureau_loaded2->name, $bureau->name);

		$this->truncateTable("bureaux");
	}
	
	function test_delete() {
		$bureau = new Bureau();
		$bureau->name = "Bureau de vote n°1 Allennes les Marais avec changement";
		$bureau->save();
		
		$bureau_loaded = new Bureau();
		$this->assertTrue($bureau_loaded->load(array('id' => 1)));
		
		$this->assertTrue($bureau->delete());
		
		$this->assertFalse($bureau_loaded->load(array('id' => 1)));
		
		$this->truncateTable("bureaux");
	}
}
