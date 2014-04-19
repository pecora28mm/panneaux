<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

require_once __DIR__."/../sources/bootloader.php";

class tests_Passages extends TableTestCase {
	function __construct() {
		parent::__construct();
		$this->initializeTables(
			"bureaux",
			"passages"
		);
	}
	
	function test_select__last__pattern() {
		$bureau = new Bureau();
		$bureau->name = "Lille 1";
		$bureau->address = "1 rue Première";
		$bureau->postcode = "59000";
		$bureau->city = "Lille";
		$bureau->save();
		
		$bureau_2 = new Bureau();
		$bureau_2->name = "Lille 2";
		$bureau_2->address = "2 rue Seconde";
		$bureau_2->postcode = "59000";
		$bureau_2->city = "Lille";
		$bureau_2->save();
		
		$passage = new Passage();
		$passage->bureaux_id = $bureau->id;
		$passage->etats_id = 1;
		$passage->actions_id = 1;
		$passage->save();
		
		$passage = new Passage();
		$passage->bureaux_id = $bureau_2->id;
		$passage->etats_id = 2;
		$passage->actions_id = 1;
		$passage->save();
		
		$passages = new Passages();
		$passages->last = true;
		$passages->select();
		$this->assertEqual(count($passages), 2);
		
		$passages = new Passages();
		$passages->last = true;
		$passages->pattern = "59000";
		$passages->select();
		$this->assertEqual(count($passages), 2);
		
		$passages = new Passages();
		$passages->last = true;
		$passages->pattern = "Première";
		$passages->select();
		$this->assertEqual(count($passages), 1);

		$passages = new Passages();
		$passages->last = true;
		$passages->pattern = "Troisième";
		$passages->select();
		$this->assertEqual(count($passages), 0);

		$this->truncateTables("bureaux", "passages");
	}

	function test_select__last() {
		$bureau = new Bureau();
		$bureau->name = "Lille 1";
		$bureau->address = "1 rue Première";
		$bureau->postcode = "59000";
		$bureau->city = "Lille";
		$bureau->save();
		
		$bureau_2 = new Bureau();
		$bureau_2->name = "Lille 2";
		$bureau_2->address = "2 rue Seconde";
		$bureau_2->postcode = "59000";
		$bureau_2->city = "Lille";
		$bureau_2->save();
		
		$passage = new Passage();
		$passage->bureaux_id = $bureau->id;
		$passage->etats_id = 1;
		$passage->actions_id = 1;
		$passage->save();
		
		$passage = new Passage();
		$passage->bureaux_id = $bureau->id;
		$passage->etats_id = 2;
		$passage->actions_id = 1;
		$passage->save();
		
		$passages = new Passages();
		$passages->last = true;
		$passages->select();
		$this->assertEqual(count($passages), 1);
		$this->assertEqual($passages[0]->etats_id, 2);
		
		$passages = new Passages();
		$passages->etats_id = 111;
		$passages->last = true;
		$passages->select();
		$this->assertEqual(count($passages), 0);
		
		$passages = new Passages();
		$passages->etats_id = 2;
		$passages->actions_id = 2;
		$passages->last = true;
		$passages->select();
		$this->assertEqual(count($passages), 0);
		
		$this->truncateTables("bureaux", "passages");
	}
	
	function test_display() {
		$bureau = new Bureau();
		$bureau->name = "Lille 1";
		$bureau->address = "1 rue Première";
		$bureau->postcode = "59000";
		$bureau->city = "Lille";
		$bureau->save();
		
		$passage = new Passage();
		$passage->bureaux_id = $bureau->id;
		$passage->comment = "C'est vraiment une panneau terrible";
		$passage->etats_id = "2";
		$passage->actions_id = "3";
		$passage->day = mktime(0, 0, 0, 4, 3, 2014);
		$passage->save();

		$passages = new Passages();
		$passages->select();
		
		$this->assertPattern("/".$bureau->name."/", $passages->display());
		
		$this->truncateTable("bureaux", "passages");
	}
}
