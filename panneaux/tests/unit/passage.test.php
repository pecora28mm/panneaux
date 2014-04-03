<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

require_once __DIR__."/../sources/bootloader.php";

class tests_Passage extends TableTestCase {
	function __construct() {
		parent::__construct();
		$this->initializeTables(
			"passages"
		);
	}
	
	function test_clean() {
		$post = array (
			'id' => "0",
			'bureaux_id' => "2",
			'comment' => "Voici ce que j'ai fait... ",
			'etats_id' => "1_0",
			'actions_id' => " 3",
			'day' => array('d' => 3, 'm' => 4, 'Y' => 2014),
		);
		$cleaned = array (
			'id' => "0",
			'bureaux_id' => "2",
			'comment' => "Voici ce que j'ai fait...",
			'etats_id' => "1",
			'actions_id' => "3",
			'day' => mktime(0, 0, 0, 4, 3, 2014),
		);
		$passage = new Passage();
		$this->assertEqual($passage->clean($post), $cleaned);
	}
	
	function test_edit() {
		$passage = new Passage();
		$this->assertPattern("/passage\[id\]/", $passage->edit());
		$this->assertPattern("/passage\[bureaux_id\]/", $passage->edit());
		$this->assertPattern("/passage\[comment\]/", $passage->edit());
		$this->assertPattern("/passage\[etats_id\]/", $passage->edit());
		$this->assertPattern("/passage\[actions_id\]/", $passage->edit());
		$this->assertPattern("/passage\[day\]/", $passage->edit());
	}

	function test_save_load() {
		$passage = new Passage();
		$passage->bureaux_id = "1";
		$passage->comment = "C'est vraiment une panneau terrible";
		$passage->etats_id = "2";
		$passage->actions_id = "3";
		$passage->day = mktime(0, 0, 0, 4, 3, 2014);
		$this->assertTrue($passage->save());

		$passage_loaded = new Passage();
		$passage_loaded->id = 1;
		$passage_loaded->load();
		
		$this->assertEqual($passage_loaded->bureaux_id, $passage->bureaux_id);
		$this->assertEqual($passage_loaded->comment, $passage->comment);
		$this->assertEqual($passage_loaded->etats_id, $passage->etats_id);
		$this->assertEqual($passage_loaded->actions_id, $passage->actions_id);
		$this->assertEqual($passage_loaded->day, $passage->day);
		
		$this->truncateTable("passages");
	}
	
	function test_day() {
		$passage = new Passage();
		$passage->bureaux_id = "1";
		$passage->comment = "C'est vraiment une panneau terrible";
		$passage->etats_id = "2";
		$passage->actions_id = "3";
		$passage->day = mktime(0, 0, 0, 4, 3, 2014);
		$passage->save();
		
		$passage_loaded = new Passage();
		$passage_loaded->load(array('id' => $passage->id));
		$passage_loaded->name = "Passage de vote n°1 Allennes les Marais avec changement";
		$this->assertTrue($passage_loaded->update());
		
		$passage_loaded2 = new Passage();
		$passage_loaded2->load(array('id' => $passage->id));
		$this->assertEqual($passage_loaded2->comment, $passage_loaded->comment);

		$this->truncateTable("passages");
	}
	
	function test_delete() {
		$passage = new Passage();
		$passage->comment = "Passage de vote n°1 Allennes les Marais avec changement";
		$passage->save();
		
		$passage_loaded = new Passage();
		$this->assertTrue($passage_loaded->load(array('id' => 1)));
		
		$this->assertTrue($passage->delete());
		
		$this->assertFalse($passage_loaded->load(array('id' => 1)));
		
		$this->truncateTable("passages");
	}
}
